<template>
  <main>
    <form name="board" method="post">
      <div class="form-group">
        <label for="board_title" class="required">Title</label>
        <input
          type="text"
          id="board_title"
          name="board[title]"
          required="required"
          maxlength="255"
          pattern=".{10,}"
          placeholder="Titre de la Board"
          class="form-control"
        />
      </div>
      <div class="form-group">
        <div class="form-check">
          <input
            type="checkbox"
            id="board_private"
            name="board[private]"
            class="form-check-input"
            value="1"
          />
          <label class="form-check-label" for="board_private">Private</label>
        </div>
      </div>
      <div class="form-group">
        <label for="board_content">Content</label>
        <textarea
          id="board_content"
          name="board[content]"
          placeholder="Vos flux RSS"
          class="form-control"
        ></textarea>
      </div>

      <ul
        class="sources"
        data-prototype="<div id=&quot;board_sources___name__&quot;><div class=&quot;form-group&quot;><label for=&quot;board_sources___name___url&quot;>Url</label><input type=&quot;text&quot; id=&quot;board_sources___name___url&quot; name=&quot;board[sources][__name__][url]&quot; placeholder=&quot;https://domain.com/subdomain.xml&quot; inputmode=&quot;url&quot; class=&quot;form-control&quot; /></div><div class=&quot;form-group&quot;><label for=&quot;board_sources___name___filterLimitItems&quot; class=&quot;required&quot;>Filter limit items</label>        <input type=&quot;range&quot; id=&quot;board_sources___name___filterLimitItems&quot; name=&quot;board[sources][__name__][filterLimitItems]&quot; min=&quot;0&quot; max=&quot;100&quot; class=&quot;form-control&quot; /></div><div class=&quot;form-group&quot;><label for=&quot;board_sources___name___filterMustContain&quot;>Filter must contain</label><input type=&quot;text&quot; id=&quot;board_sources___name___filterMustContain&quot; name=&quot;board[sources][__name__][filterMustContain]&quot; class=&quot;form-control&quot; /></div><div class=&quot;form-group&quot;><label for=&quot;board_sources___name___filterMustExclude&quot;>Filter must exclude</label><input type=&quot;text&quot; id=&quot;board_sources___name___filterMustExclude&quot; name=&quot;board[sources][__name__][filterMustExclude]&quot; class=&quot;form-control&quot; /></div></div>"
      >
        <li>
          <button type="button" class="add_source_link">Add a Source</button>
        </li>
      </ul>

      <ul
        class="tags"
        data-prototype="<div id=&quot;board_tags___name__&quot;><div class=&quot;form-group&quot;><label for=&quot;board_tags___name___label&quot; class=&quot;required&quot;>Label</label><input type=&quot;text&quot; id=&quot;board_tags___name___label&quot; name=&quot;board[tags][__name__][label]&quot; required=&quot;required&quot; maxlength=&quot;255&quot; class=&quot;form-control&quot; /></div></div>"
      >
        <li>
          <button type="button" class="add_tag_link">Add a Tag</button>
        </li>
      </ul>

      <button type="submit" class="btn btn-success">Ajouter la Board</button>

      <fieldset class="form-group">
        <legend class="col-form-label required">Sources</legend>
        <div id="board_sources"></div>
      </fieldset>
      <fieldset class="form-group">
        <legend class="col-form-label required">Tags</legend>
        <div id="board_tags"></div>
      </fieldset>

      <input type="hidden" v-bind:id="token.id" v-bind:name="token.name" v-bind:value="token.value" />
    </form>
    <button v-on:click="deleteBoard">Delete Board</button>
  </main>
</template>


<script>
let token = JSON.parse(
  document.getElementById("layout").getAttribute("data-token")
);

export default {
  data() {
    return {
      token: token
    };
  },
  methods: {
    deleteBoard: function(event) {
      if (confirm("Are you sure to remove Board?")) {
        let uuid = document
          .getElementById("layout")
          .getAttribute("data-boarduuid");

        //Fetch request to the Backend:

        fetch(`/board/uuid/${uuid}/delete`, {
          method: "DELETE"
        }).then(res => window.location.reload());
      }
    }
  },
  components: {}
};

// var newSourcesUl;
// var exsSourcesList;
// var addSourceBtn = $(
//   '<button type="button" class="add_source_link">Add a Source</button>'
// );
// var addSourceLi = $("<li></li>").append(addSourceBtn);

// var newTagsUl;
// var exsTagsList;
// var addTagBtn = $(
//   '<button type="button" class="add_tag_link">Add a Tag</button>'
// );
// var addTagLi = $("<li></li>").append(addTagBtn);

// function pushDeleteBtn(elem, context) {
//   var btnDelete = $(
//     '<button type="button">Delete this ' + context + "</button>"
//   );

//   elem.append(btnDelete);

//   btnDelete.on("click", function(e) {
//     elem.remove();
//   });
// }

// function addSourceForm(newSourcesUl, addSourceLi) {
//   var prototype = newSourcesUl.data("prototype");
//   var index = newSourcesUl.data("index");
//   var newForm = prototype;

//   // Replace '__name__' in the prototype's HTML to
//   // instead be a number based on how many items we have
//   newForm = newForm.replace(/__name__/g, index);

//   // increase the index with one for the next item
//   newSourcesUl.data("index", index + 1);

//   // Display the form in the page in an li, before the "Add a Source" link li
//   var $newFormLi = $("<li></li>").append(newForm);
//   addSourceLi.before($newFormLi);

//   // add a delete link to the new form
//   pushDeleteBtn($newFormLi, "source");
// }

// function addTagForm(newTagsUl, addTagLi) {
//   var prototype = newTagsUl.data("prototype");
//   var index = newTagsUl.data("index");
//   var newForm = prototype;

//   // Replace '__name__' in the prototype's HTML to
//   // instead be a number based on how many items we have
//   newForm = newForm.replace(/__name__/g, index);

//   // increase the index with one for the next item
//   newTagsUl.data("index", index + 1);

//   // Display the form in the page in an li, before the "Add a Source" link li
//   var $newFormLi = $("<li></li>").append(newForm);
//   addTagLi.before($newFormLi);

//   // add a delete link to the new form
//   pushDeleteBtn($newFormLi, "tag");
// }

// jQuery(document).ready(function() {
//   newSourcesUl = $("ul.sources");
//   newTagsUl = $("ul.tags");

//   // Push a "Delete" button for all new sources and new tags.
//   newSourcesUl.find("li").each(function() {
//     pushDeleteBtn($(this), "source");
//   });
//   newTagsUl.find("li").each(function() {
//     pushDeleteBtn($(this), "tag");
//   });

//   // Push a global "Add a Source" and a "Add a Tag" button.
//   newSourcesUl.append(addSourceLi);
//   newTagsUl.append(addTagLi);

//   // count the current form inputs we have (e.g. 2), use that as the new
//   // index when inserting a new item (e.g. 2)
//   newSourcesUl.data("index", newSourcesUl.find("input").length);
//   newTagsUl.data("index", newTagsUl.find("input").length);

//   addSourceBtn.on("click", function(e) {
//     addSourceForm(newSourcesUl, addSourceLi);
//   });
//   addTagBtn.on("click", function(e) {
//     addTagForm(newTagsUl, addTagLi);
//   });
// });
</script>


<!-- Css -->
<style>
</style>