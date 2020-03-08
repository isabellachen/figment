(function($) {
  $(document).ready(function() {
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
          if (json.status === 'publish') {
            alert(`Success! Your story ${json.title.rendered} published!`);
          }
          if (json.data && json.data.status >= 400) {
            const status = json.data.status;
            const code = json.code;
            const message = json.message;
            throw new Error(`Status:${status} Code:${code} Message:${message}`);
          }
        })
        .catch(error => {
          console.error(error);
          alert(error);
        });
    }

    $('#simpleMdeForm').submit(function(event) {
      const title = $('#storyTitle').val();
      const category = $('#storyCategory').val();
      const body = simpleMde.value();
      const postData = {
        title: title,
        content: body,
        categories: [category],
        status: 'publish'
      };
      postStory(postData);
      event.preventDefault();
    });
  });
})(jQuery);
