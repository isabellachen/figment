(function($) {
  const postData = {
    title: 'Orange is the new black',
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    status: 'publish'
  };
  $(document).ready(function() {
    console.log(scriptVars.currentUser);
    function postStory(postData) {
      window
        .fetch(`${scriptVars.endpoint}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': scriptVars.nonce
          },
          credentials: 'same-origin',
          body: JSON.stringify(postData)
        })
        .then(response => response.json())
        .then(json => {
          alert(json.message);
        });
    }

    $('#simpleMdeForm').submit(function(event) {
      const title = $('#storyTitle').val();
      const body = simpleMde.value();
      const postData = {
        title: title,
        content: body,
        status: 'publish'
      };
      postStory(postData);
      event.preventDefault();
    });
  });
})(jQuery);
