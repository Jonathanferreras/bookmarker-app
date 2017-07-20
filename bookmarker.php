<?php
  session_start();

  if(isset($_POST['name'])) {
    if(isset($_SESSION['bookmarks'])) {
      $_SESSION['bookmarks'][$_POST['name']] = $_POST['url'];
    } else {
      $_SESSION['bookmarks'] = Array($_POST['name'] => $_POST['url']);
    }
  }

  //clear all bookmarks
  if(isset($_GET['action']) && $_GET['action'] == 'clear') {
    session_unset();
    session_destroy();
    header("Location: bookmarker.php");
  }

  //remove individual bookmark
  if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    unset($_SESSION['bookmarks'][$_GET['name']]);
    header("Location: bookmarker.php");
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bookmarker</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/cyborg/bootstrap.min.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Bookmarker</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="bookmarker.php?action=clear">Clear all</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
              <label>Website Name</label>
              <input class="form-control" type="text" name="name">
            </div>
            <div class="form-group">
              <label>Website URL</label>
              <input class="form-control" type="text" name="url">
            </div>
            <input class="btn btn-default" type="submit" value="Submit">
          </form>
        </div>
        <div class="col-md-5">
          <?php if(isset($_SESSION['bookmarks'])) : ?>
            <ul>
              <?php foreach($_SESSION['bookmarks'] as $name => $url): ?>
                <li class="list-group-item">
                  <a href="<?php echo $url; ?>" target="_blank">
                    <?php echo $name; ?>
                  </a>
                  <a style="color:white;"class="delete" href="bookmarker.php?action=delete&name=<?php echo $name ?>">
                    &nbsp;<i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>
