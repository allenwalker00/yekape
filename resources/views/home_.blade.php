<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Materialize Social</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{asset('assets/css/materialize.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="{{asset('assets/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection" />
    <link rel="stylesheet" href="{{asset('assets/css/materialize-social.css')}}">
</head>

<body>
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Materialize-Social</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="https://github.com/TerryMooreII/materialize-social">Github</a></li>
                <li><a href="https://twitter.com/terrymooreii">Twitter</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="#">Navbar Link</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Materialize Social</h1>
            <div class="row center">
                <h5 class="header col s12 light">Social Login Buttons for Materailize CSS with Font-Awesome</h5>
            </div>
            <div class="row center">
                <a href="https://github.com/TerryMooreII/materialize-social" id="download-button" class="btn-large waves-effect waves-light orange">View Code on Github</a>
            </div>
            <br>
            <hr>
            <br>
            <h6 class="header col s12 light info">
              Just add either the <code>.social</code> or <code>.social-icon</code> to any <a href="http://materializecss.com/buttons.html">Materialize</a> button along with the auth providers class and BAM!
              Instant login buttons.
            </h5>
            <br><br>
        </div>
    </div>


    <div class="container">
        <div class="section">

            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m4 all"></div>

                <div class="col s12 m8 examples">
                  <ul class="collection with-header">
                  <li class="collection-header"><h4>Examples</h4></li>

                  <li class="collection-item">

                    <a class="waves-effect waves-light btn social google"><i class="fa fa-google"></i> Sign in with Google</a>
                    <pre>
                      <code>
&#x3C;a class=&#x22;waves-effect waves-light btn social google&#x22;&#x3E;
&#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E; Sign in with Google&#x3C;/a&#x3E;
                      </code>
                    </pre>
                  </li>
                  <li class="collection-item">

                    <a class="waves-effect waves-light btn-large social google"><i class="fa fa-google"></i> Sign in with Google</a>
                    <pre>
                      <code>
&#x3C;a class=&#x22;waves-effect waves-light btn-large social google&#x22;&#x3E;
&#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E; Sign in with Google&#x3C;/a&#x3E;
                      </code>
                    </pre>
                  </li>
                  <li class="collection-item row">

                    <div class="row">
                      <a class="waves-effect waves-light btn col s12 social google"><i class="fa fa-google"></i> Sign in with Google</a>
                    </div>
                    <pre>
                      <code>
&#x3C;div class=&#x22;row&#x22;&#x3E;
  &#x3C;a class=&#x22;waves-effect waves-light btn col s12 social google&#x22;&#x3E;
  &#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E; Sign in with Google&#x3C;/a&#x3E;
&#x3C;/div&#x3E;

                      </code>
                    </pre>
                  </li>
                  <li class="collection-item">

                    <a class="waves-effect waves-light btn-floating social google"><i class="fa fa-google"></i> Sign in with Google</a>
                    <pre>
                      <code>
&#x3C;a class=&#x22;waves-effect waves-light btn-floating social google&#x22;&#x3E;
&#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E; Sign in with Google&#x3C;/a&#x3E;
                      </code>
                    </pre>
                  </li>
                  <li class="collection-item">

                    <a class="waves-effect waves-light btn-floating btn-large social google"><i class="fa fa-google"></i> Sign in with Google</a>
                    <pre>
                      <code>
&#x3C;a class=&#x22;waves-effect waves-light btn-floating btn-large social google&#x22;&#x3E;
&#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E; Sign in with Google&#x3C;/a&#x3E;
                      </code>
                    </pre>
                  </li>
                  <li class="collection-item">

                    <a class="waves-effect waves-light social-icon btn google"><i class="fa fa-google"></i></a>
                    <pre>
                      <code>
&#x3C;a class=&#x22;waves-effect waves-light social-icon btn google&#x22;&#x3E;
&#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/a&#x3E;
                      </code>
                    </pre>
                  </li>
                  <li class="collection-item">

                    <a class="waves-effect waves-light social-icon btn-large google"><i class="fa fa-google"></i></a>
                    <pre>
                      <code>
&#x3C;a class=&#x22;waves-effect waves-light social-icon btn-large google&#x22;&#x3E;
&#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/a&#x3E;
                      </code>
                    </pre>
                  </li>
                  <li class="collection-item">
                    <h6>See bottom corner of the screen</h6>
                    <div class="fixed-action-btn horizontal click-to-toggle">
                        <a class="btn-floating btn-large red">
                            <i class="material-icons">menu</i>
                        </a>
                        <ul>
                            <li>
                                <a class="waves-effect waves-light btn-floating social google"><i class="fa fa-google"></i></a>
                            </li>
                            <li>
                                <a class="waves-effect waves-light btn-floating facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a class="waves-effect waves-light btn-floating github"><i class="fa fa-github"></i></a>
                            </li>
                        </ul>
                    </div>
                    <pre>
                      <code>
&#x3C;div class=&#x22;fixed-action-btn horizontal click-to-toggle&#x22;&#x3E;
  &#x3C;a class=&#x22;btn-floating btn-large red&#x22;&#x3E;
      &#x3C;i class=&#x22;material-icons&#x22;&#x3E;menu&#x3C;/i&#x3E;
  &#x3C;/a&#x3E;
  &#x3C;ul&#x3E;
      &#x3C;li&#x3E;
          &#x3C;a class=&#x22;waves-effect waves-light btn-floating social google&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-google&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/a&#x3E;
      &#x3C;/li&#x3E;
      &#x3C;li&#x3E;
          &#x3C;a class=&#x22;waves-effect waves-light btn-floating facebook&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-facebook&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/a&#x3E;
      &#x3C;/li&#x3E;
      &#x3C;li&#x3E;
          &#x3C;a class=&#x22;waves-effect waves-light btn-floating github&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-github&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/a&#x3E;
      &#x3C;/li&#x3E;
  &#x3C;/ul&#x3E;
&#x3C;/div&#x3E;
                      </code>
                    </pre>
                  </li>
                </ul>
                </div>
            </div>

        </div>
        <br><br>

        <div class="section">
            <h4 class="header col s12 light center-align">How to use</h4>
            <ol>
                <li>
                    <h5 class="header col s12 light">Include Materialize CSS and Font Awesome</h5>
                    <p>If you haven't done that already, include the latest Materialize CSS and Font Awesome in your project.</p>
                </li>
                <li>
                    <h5 class="header col s12 light">Get the CSS and LESS</h5>
                    <p>
                        <pre>
npm install --save materialize-social
                        </pre>
                        <pre>
bower install --save materialize-social
                        </pre>
                    </p>
                </li>
                <li>
                    <h5 class="header col s12 light">Include the CSS or Less</h5>
                    <p>You have two options for enabling the social buttons in your project: vanilla CSS or source Less. For vanilla CSS, just include the <code>materialize-social.css</code> file into your project.

For Less, copy the <code>materialize-social.less</code> into your existing styles directory and import it into your base less file with <code>@import "materialize-social.less";</code>. Recompile when ready.</p>
                </li>
                <li>
                    <h5 class="header col s12 light">Add some buttons!</h5>
                    <p>See above for examples</p>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
      <div class="col s12">
        <h5 class="center-align header light">
        Special thanks to <a href="http://lipis.github.io/bootstrap-social/">Bootstrap Social</a> for the inspiration!
        </h5>
      </div>
    </div>

    <footer class="page-footer orange">
        <div class="footer-copyright">
            <div class="container">
                Made by <a class="orange-text text-lighten-3" href="https://twitter.com/terrymooreii">Terry Moore II</a>
            </div>
        </div>
    </footer>


    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>

    <script type="text/javascript">
        var social = [
            'adn',
            'bitbucket',
            'dropbox',
            'facebook',
            'flickr',
            'foursquare',
            'github',
            'google',
            'instagram',
            'linkedin',
            'windows ',
            'odnoklassniki',
            'openid',
            'pinterest',
            'reddit',
            'soundcloud',
            'tumblr',
            'twitter',
            'vimeo',
            'vk',
            'yahoo'
        ]
        var buttons = '';
        $.each(social, function(index, network) {
            buttons += '<div class="row usage '+network+'"><a class="waves-effect waves-light btn social col s12 ' + network + '"><i class="fa fa-fw fa-' + network + '"></i> Sign in with ' + network + '</a></div>'
        });
        $('.all').html(buttons);


        var current = 'google';
        $('.usage').on('mouseenter', function(){
          var icon = $(this).attr('class').replace('row usage ', '');

          var regex = new RegExp(current, "gi");
          $('.examples').html(function(index, html){
            return html.replace(regex, icon);
          });
          current = icon;
        })


        //$('.example').html(html)

    </script>

</body>

</html>
