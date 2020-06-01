<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Board;
use App\Entity\Source;
use App\Form\BoardType;
use App\Renderer\BoardRenderer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoardController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    /**
     * @Route ("/board/new" , name="board_create")
     * @Route ("/board/{slug}/edit" , name="board_edit")
     */
    public function boardManage(Board $board = null, Request $request, EntityManagerInterface $manager, Security $security)
    {
        // Get route context & redirects:
        $route = $request->get('_route');

        $user = $this->security->getUser();
        if(is_null($user)){
            return $this->redirectToRoute('security_login');
        }

        if ($route === "board_edit"){
            if(!$board){
                return $this->redirectToRoute('board_create');
            }

            if($user->getId() !== $board->getOwnerId()){
                throw new \RuntimeException('You don\'t have the permission to edit this Board.');
            }
        }

        // Init needed objects depending of the route:
        if($route === "board_create"){
            $originalBoardSlug = null;
            $initialStateSources = null;
            $initialStateTags = null;
            $board = new Board();
        }
        elseif($route === "board_edit") {
            $originalBoardSlug = $board->getSlug();
            // $initialStateSources = $this->constructInitialSources($board);
            $initialStateTags = $this->constructInitialTags($board);
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
                $board->setOwnerId($user->getId());
            } 
            elseif($route === "board_edit"){
                $board->setModifiedAt(new \DateTime());
            }

            $this->sourcesManager($manager, $route, $board);

            $this->tagsManager($manager, $route, $board, $initialStateTags);


            $manager->persist($board);
            $manager->flush();

            $this->removeOrphanedTags($request, $manager);

            return $this->redirectToRoute('board_show', [
                'slug' => $board->getSlug()
            ]);
        }

        return $this->render('board/create.html.twig', [
            'formBoard' => $form->createView(),
            'board' => $board,
            'route' => $route
        ]);
    }

    /**
     * @Route ("/board/{id}/delete" , name="board_delete")
     * @Method({"DELETE"})
     */
    public function boardDelete(Board $board, Request $request, EntityManagerInterface $manager)
    {
        if(!$board){
            throw new \RuntimeException('Board dosn\'t exist. You can\'t remove it.');
        }
        $user = $this->security->getUser();
        if($user->getId() !== $board->getOwnerId()){
            throw new \RuntimeException('You don\'t have the permission to delete this Board.');
        }
        
        $manager->remove($board);
        $manager->flush();
        
        $this->removeOrphanedTags($request, $manager);

        $response = new Response();
        $response->send();
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

        $renderer = new BoardRenderer($board);

        return $this->render('board/board.html.twig', [
            'controller_name' => 'BoardController',
            'board' => $board,
            'items' => $renderer->items,
            'languages' => $renderer->languages,
            'slug' => $slug,
        ]);
    }


    /*** Utilitaries ***/
    public function removeOrphanedTags(Request $request, EntityManagerInterface $manager){
        $tags = $this->getDoctrine()->getRepository(Tag::class)->findAll();

        foreach($tags as $tag){
            if($tag->getBoard()->isEmpty()){
                $manager->remove($tag);
            }
        }

        $manager->flush();
    }

    private function filterSlugWords($slug){
        //http://www.bannedwordlist.com/lists/swearWords.xml
        $bannedWords = ["anal","anus","ballsack","bastard","bitch","biatch","blowjob","blow job","bollock","bollok","boob","buttplug","cunt","dildo","fellate","fellatio","fuck","f u c k","jizz","nigger","nigga","penis","piss","poop","pussy","scrotum","shit","s hit","sh1t","slut","smegma","spunk","whore"];
        
        foreach($bannedWords as $i) {
            if (stripos($slug, $i) !== false) dd(stripos($slug, $i));
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
                throw new \RuntimeException('Slug is already exist in Database. Please find one another.');
            }
        }
        else {
            if ($originalBoardSlug !== $board->getSlug()){
                if(!empty($existingBoard)){
                    throw new \RuntimeException('Slug is already exist in Database. Please find one another.');
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

    private function undoEmptyFiltersArray($source){

        $containTrimmedArray = array_filter($source->getFilterMustContain());
        $source->setFilterMustContain($containTrimmedArray);

        $excludeTrimmedArray = array_filter($source->getFilterMustExclude());
        $source->setFilterMustExclude($excludeTrimmedArray);

    }

    private function constructInitialTags($board){
        $initialStateTags = [];
        $hinderTagEdit = [];
        $initialTags = new ArrayCollection();

        foreach ($board->getTags() as $tag) {
            $initialTags->add($tag);
            $hinderTagEdit[] = [
                "id" => $tag->getId(),
                "label" => $tag->getLabel(),
            ];
        }

        $initialStateTags["initialTags"] = $initialTags;
        $initialStateTags["hinderTagEdit"] = $hinderTagEdit;

        return $initialStateTags;
    }

    private function sourcesManager($manager, $route, $board){
        $repoSource = $this->getDoctrine()->getRepository(Source::class);
        $sources = $board->getSources();

        foreach ($sources as $source){
            $source->setCreatedAt(new \DateTime());

            $this->getSourceIcon($source);

            $this->verifySourceUrl($source);

            $this->undoEmptyFiltersArray($source);

            $board->addSource($source);
            $manager->persist($source);
        }
    }

    private function tagsManager($manager, $route, $board, $initialStateTags = null){
        $repoTag = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $board->getTags();

        foreach($tags as $tag){
            // Avoid override database if tag already exist by one another board.
            $existingTag = $repoTag->findOneByLabel($tag->getLabel());
            if(!empty($existingTag)){
                $board->removeTag($tag);
                $tag = $existingTag;
            }

            // Prevent users for editing tags even if it is prohibited by readonly attr form. (in the case the new tag is not existing in ddb)
            if(isset($initialStateTags) && !empty($initialStateTags)){
                foreach($initialStateTags["hinderTagEdit"] as $hinderTagEdit){
                    if(($tag->getId() === $hinderTagEdit["id"]) && ($tag->getLabel() !== $hinderTagEdit["label"])){
                        throw new \RuntimeException('You tried to replace Label "' . $hinderTagEdit["label"] . '" by "' . $tag->getLabel() . '", but it\'s unauthorized. If you want to change it, please delete it and create new tag instead.');
                    }
                }
            }

            $board->addTag($tag);
            $manager->persist($tag);
        }

        // Remove the relationship between the Tag and the Board, if tag is deleted.
        if($route === "board_edit"){
            foreach ($initialStateTags["initialTags"] as $initialTag) {
                if(false === $tags->contains($initialTag)) {
                    $initialTag->getBoard()->removeElement($board);
                }
            }
        }
    }
}
