<html xmlns="http://www.w3.org/1999/xhtml"
  xmlns:fb="https://www.facebook.com/2008/fbml">
  <head>
    <title>My Add to Page Dialog Page</title>
  </head>
  <body>
    <div id='fb-root'></div>
    <script src='https://connect.facebook.net/en_US/all.js'></script>
    <p><a onclick='addToPage(); return false;'>Add to page</a></p>
    <p id='msg'></p>

    <script> 
      FB.init({appId: "393724054071446", status: true, cookie: true});

      function addToPage() {

        // calling the API ...
        var obj = {
          method: 'pagetab'
        };

        FB.ui(obj);
      }
    
    </script>
  </body>
</html>