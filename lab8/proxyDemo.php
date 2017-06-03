<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style type="text/css">
            textarea {
                width: 500px;
                height: 100px;
            }

            textarea[name="results"] {
                height: 300px;
            }
        </style>

        <h1>Rest API Demo</h1>

        Verb/HTTP Method:<br />
        <select name="verb">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select>
        <br />
        <br />
        Resource for endpoint:<br />
        <input name="resource" value="address" />
        <br />
        <br />
        Data(optional):<br />
        email <input type="email" name="email" value="" />
        <br />
        password <input type="password" name="pass" value="" />
        <br />
        <br />
        <br />
        <button>Make Call</button>
        <h3>Results</h3>

        <textarea name="results"></textarea>

        <script type="text/javascript">

            document.querySelector('button').addEventListener('click', makeCall);

            function makeCall() {
                var verbfield = document.querySelector('select[name="verb"]');
                var verb = verbfield.options[verbfield.selectedIndex].value;
                var resource = document.querySelector('input[name="resource"]').value;
                var data = {
                    'email': document.querySelector('input[name="email"]').value,
                    'password': document.querySelector('input[name="pass"]').value
                };
                var results = document.querySelector('textarea[name="results"]');

                var httpRequest = new XMLHttpRequest();

                var url = './api/v1/' + resource;

                httpRequest.open(verb, url, true);
                httpRequest.addEventListener('readystatechange', callComplete);
                
                function callComplete() {
                     if ( this.readyState === XMLHttpRequest.DONE ) {
                        console.log(this.responseText);
                        results.value = this.responseText;
                        var response = JSON.parse(this.responseText);

                        if (response && response.data && response.data.hasOwnProperty('token')) {
                            window.localStorage.setItem('token', response.data.token);
                        }
                     } // else waiting for the call to complete
                }
                
                var token = window.localStorage.getItem('token');
                if (token) {
                    httpRequest.setRequestHeader("Authorization", "Bearer " + token);
                }

                if (verb === 'GET') {
                    httpRequest.send(null);
                } else {
                    httpRequest.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
                    httpRequest.send(JSON.stringify(data));
                }
                
            }
        </script>

    </body>
</html>
