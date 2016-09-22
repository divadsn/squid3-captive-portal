<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- So meta -->
    <meta charset="utf-8" />
    <title>Squid3 Captive Portal</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="author" content="Codebucket" />
    <meta name="description" content="Squid3 setup for restricting access by captive portal. Users are required to log in before they will be allowed to access the Internet and access local resources." />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="3 month" />

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="/favicon.ico" />

    <!--
      You enjoy inspecting the sourcecode of my websites?
      Why do you not follow me on Github and review some of my projects?
      https://github.com/codebucketdev
    -->

    <!-- Bootstrap style CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />

    <!-- jQuery (other js is loaded in the footer) -->
    <script src="/assets/js/jquery.min.js"></script>
  </head>
  <body>
    <div class="background"></div>
    <div class="container">
      <div class="buffer visible-xs"></div>
      <div class="hidden-xs" style="padding-top: 10%"></div>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Welcome to the Guest Network <i class="fa fa-lock fa-fw pull-right"></i></h3>
            </div>
            <div class="panel-body">
              <?php if ($logged_in): ?>
              <p>Please wait while we enable the Internet for you...</p>
              <div class="progress panel-bottom">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
              </div>
              <script>
                setTimeout(function () {
                  window.location.href = "<?= $url; ?>";
                }, 5000);
              </script>
              <?php else: ?>
              <form method="post" action="announce.php" accept-charset="utf-8" role="form">
                <fieldset>
                  <p>By using the Guest Network you are agreeing to comply with and be bound by the following terms and conditions of use. If you disagree with any part of these terms and conditions, you may not use the Guest Network.</p>
                  <ul>
                    <li>Causing a security breach to either this or other network resources, including, but not limited to, accessing data, servers, or accounts to which you are not authorized; circumventing user authentication on any device; or sniffing network traffic. </li>
                    <li>Causing a disruption of service to either this or other network resources, including, but not limited to, ICMP floods, packet spoofing, denial of service, heap or buffer overflows, and forged routing information for malicious purposes.</li>
                    <li>Introducing honeypots, honeynets, or similar technology on this network.</li>
                    <li>Violating copyright law, including, but not limited to, illegally duplicating or transmitting copyrighted pictures, music, video, and software. </li>
                    <li>Exporting or importing software, technical information, encryption software, or technology in violation of international or regional export control laws.</li>
                    <li>Use of the Internet or this network that violates local laws.</li>
                    <li>Intentionally introducing malicious code, including, but not limited to, viruses, worms, Trojan horses, e-mail bombs, spyware, adware, and keyloggers. </li>
                    <li>Port scanning or security scanning on a production network unless authorized in advance by Information Security.</li>
                  </ul>
                  <span class="help-block">By clicking on "Continue", you agree to the Terms and Conditions and our Privacy Policy.</span>
                  <input class="form-control" name="redirect_to" type="hidden" value="<?= $url; ?>" />
                  <input class="form-control" name="form_id" type="hidden" value="<?= $form_hash; ?>" />
                  <input class="btn btn-lg btn-success btn-block" name="submit" type="submit" value="Continue" />
                </fieldset>
              </form>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/app.js"></script>
  </body>
</html>
