<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Board;
use App\Entity\Source;
use App\Form\BoardType;
use App\Factory\BoardContentFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoardController extends AbstractController
{
    /*** Routes ***/

    /**
     * @Route ("/board/new" , name="board_create")
     * @Route ("/board/{slug}/edit" , name="board_edit")
     */
    public function boardManage(Board $board = null, Request $request, EntityManagerInterface $manager)
    {
        // Get route context:
        $route = $request->get('_route');

        if($route === "board_edit" && !$board){
            return $this->redirectToRoute('board_create');
        }

        // Init needed objects depending of the route:
        if($route === "board_create"){
            $originalBoardSlug = null;
            $originalSources = null;
            $originalTags = null;

            $board = new Board();
        }
        elseif ($route === "board_edit") {
            $originalBoardSlug = $board->getSlug();
            $originalSources = new ArrayCollection();
            $originalTags = new ArrayCollection();

            foreach ($board->getSources() as $source) {
                $originalSources->add($source);
            }

            foreach ($board->getTags() as $tag) {
                $originalTags->add($tag);
            }
        }

        // Create Form:
        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);

        // Check Submit Form:
        if($form->isSubmitted() && $form->isValid()){
            $this->verifySlug($route, $board, $originalBoardSlug);

            if($route === "board_create"){
                $board->setCreatedAt(new \DateTime());
                $board->setScore(0);
                $board->setOwnerId(1);
            }

            $this->sourcesManager($manager, $route, $board, $originalSources);

            $this->tagsManager($manager, $route, $board, $originalTags);

            // Persist Datas in DDB:
            $manager->persist($board);
            $manager->flush();

            return $this->redirectToRoute('board_show', [
                'slug' => $board->getSlug()
            ]);
        }

        return $this->render('board/create.html.twig', [
            'formBoard' => $form->createView(),
            'route' => $route
        ]);
    }

    /**
     * @Route("/board/{slug}", name="board_show")
     */
    public function boardShow($slug)
    {
        $repo = $this->getDoctrine()->getRepository(Board::class);

        $board = $repo->findOneBySlug($slug);

        if(empty($board)){
            throw new \RuntimeException('The board dosn\'t exist. Verify url');
        }

        $factory = new BoardContentFactory($board);

        return $this->render('board/board.html.twig', [
            'controller_name' => 'BoardController',
            'board' => $board,
            'items' => $factory->items,
            'languages' => $factory->languages,
            'slug' => $slug,
        ]);
    }


    /*** Utilitaries ***/
    private function filterSlugWords($slug){
        //http://www.bannedwordlist.com/lists/swearWords.xml
        $bannedWords = ["anal","anus","arse","ass","ballsack","balls","bastard","bitch","biatch","bloody","blowjob","blow job","bollock","bollok","boner","boob","bugger","bum","butt","buttplug","clitoris","cock","coon","crap","cunt","damn","dick","dildo","dyke","fag","feck","fellate","fellatio","felching","fuck","f u c k","fudgepacker","fudge packer","flange","Goddamn","God damn","hell","homo","jerk","jizz","knobend","knob end","labia","lmao","lmfao","muff","nigger","nigga","omg","penis","piss","poop","prick","pube","pussy","queer","scrotum","sex","shit","s hit","sh1t","slut","smegma","spunk","tit","tosser","turd","twat","vagina","wank","whore","wtf"];

        foreach($bannedWords as $i) {
            if (stripos($slug, $i) !== false) return false;
        }
        return true;

    }

    private function verifySlug($route, $board, $originalBoardSlug){
        $slugger = new AsciiSlugger();
        $repo = $this->getDoctrine()->getRepository(Board::class);

        $slug = strtolower($slugger->slug($board->getSlug()));
        $isSafe = $this->filterSlugWords($slug);

        if(!$isSafe){
            throw new \RuntimeException('Your slug contains some prohibited words. Please replace it.');
        }

        $board->setSlug($slug);
        $existingBoard = $repo->findBySlug($board->getSlug());

        if(!$board->getId()){
            if(!empty($existingBoard)){
                throw new \RuntimeException('Slug is already exists in Database. Please find one another.');
            }
        }
        else {
            if ($originalBoardSlug !== $board->getSlug()){
                if(!empty($existingBoard)){
                    throw new \RuntimeException('Slug is already exists in Database. Please find one another.');
                }
            }
        }
    }

    private function verifySourceUrl($source){
        $url = $source->getUrl();
        $isXml = (strpos($url, ".xml") || strpos($url, ".rss"));
        $file_headers = @get_headers($url);

        if($isXml === false){
            throw new \RuntimeException('[' . $url . '] Source is not a rss .xml url. Please change it or delete it.');
        }

        if((filter_var($url, FILTER_VALIDATE_URL) === false) || !$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'){
            throw new \RuntimeException('[' . $url . '] Source is not a valid url or target dosn\'t exist. Please replace it.');
        }

    }

    private function getSourceIcon($source){
        $url = $source->getUrl();
        $domain = parse_url($url, PHP_URL_HOST);
        $iconUrl = "https://www.google.com/s2/favicons?domain=" . $domain;
        
        $source->setIcon($iconUrl);
    }

    private function sourcesManager($manager, $route, $board, $originalSources = null){
        $repoSource = $this->getDoctrine()->getRepository(Source::class);
        $repoBoard = $this->getDoctrine()->getRepository(Board::class);
        $sources = $board->getSources();

        foreach ($sources as $source){
            // Avoid override database if source already exists by one another board.
            $existingSource = $repoSource->findOneByUrl($source->getUrl());
            if(!empty($existingSource)){
                $board->removeSource($source);
                $source = $existingSource;
            } 
            else {
                $source->setCreatedAt(new \DateTime());
            }

            $this->getSourceIcon($source);

            $this->verifySourceUrl($source);
            $board->addSource($source);
            $manager->persist($source);
        }

        // Remove the relationship between the Source and the Board, if source is deleted.
        // Also, if Source is not anymore relied to any Board, flush it.
        if($route === "board_edit"){
            foreach ($originalSources as $originalSource) {
                if(false === $sources->contains($originalSource)) {
                    $originalSource->getBoard()->removeElement($board);

                    if($originalSource->getBoard()->isEmpty()){
                        $manager->remove($originalSource);
                    }
                }
            }
        }
    }

    private function tagsManager($manager, $route, $board, $originalTags = null){
        $repoTag = $this->getDoctrine()->getRepository(Tag::class);
        $repoBoard = $this->getDoctrine()->getRepository(Board::class);
        $tags = $board->getTags();

        foreach($tags as $tag){
            // Avoid override database if tag already exists by one another board.
            $existingTag = $repoTag->findOneByLabel($tag->getLabel());
            if(!empty($existingTag)){
                $board->removeTag($tag);
                $tag = $existingTag;
            }

            $board->addTag($tag);
            $manager->persist($tag);
        }

        // Remove the relationship between the Tag and the Board, if tag is deleted.
        // Also, if Tag is not anymore relied to any Board, flush it.
        if($route === "board_edit"){
            foreach ($originalTags as $originalTag) {
                if(false === $tags->contains($originalTag)) {
                    $originalTag->getBoard()->removeElement($tag);

                    if($originalTag->getBoard()->isEmpty()){
                        $manager->remove($originalTag);
                    }
                }
            }
        }
    }
}
