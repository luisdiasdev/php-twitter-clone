<?php 
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: index.php?erro=1");
    }

    require_once 'get_functions.php';

    $id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

    $tweet_count = getTweetCount($id);

    $followers_count = getFollowersCount($id);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btn_tweet').click(function() {
                    if($("input[name='tweet_text']").val().length > 0) {
                        $.ajax({
                            url: 'include_tweet.php',
                            method: 'post',
                            data: $('#tweet_form').serialize(),
                            success: function(data) {
                                $("input[name='tweet_text']").val('');
                                showTweet();
                                var userId = $('#tweet_count').data('id');
                                updateFollowersCount(userId);
                                updateTweetCount(userId);
                            },
                        });
                    }
                });

                function updateFollowersCount(userId) {
                    $.ajax({
                        url: 'get_followers_count.php',
                        method: 'post',
                        data: { user_id : userId },
                        success: function(data) {
                            $('#followers_count').html(data);
                        }
                    })
                }
                function updateTweetCount(userId) {
                    $.ajax({
                        url: 'get_tweet_count.php',
                        method: 'post',
                        data: { user_id : userId },
                        success: function(data) {
                            $('#tweet_count').html(data);
                        }
                    })
                }
                function showTweet() {
                    $.ajax({
                        url: 'get_tweet.php',
                        success: function(data) {
                            $('#tweets').html(data);
                        },
                    });
                }

                showTweet();
            });
        </script>
	</head>

	<body>

		<!-- Static navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img src="imagens/icone_twitter.png" />
				</div>
				
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php">Sair</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>


		<div class="container">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><?= $_SESSION['username'] ?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            TWEETS <br/> <span id="tweet_count" data-id="<?php echo $id; ?>"> <?php echo $tweet_count; ?> </span>
                        </div>
                        <div class="col-md-6">
                            SEGUIDORES <br/> <span id="followers_count" data-id="<?php echo $id; ?>"> <?php echo $followers_count; ?> </span>
                        </div>
                    </div>
                </div>
            </div>

			<div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="tweet_form" class="input-group">
                            <input name="tweet_text" type="text" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140"/>
                            <span class="input-group-btn">
                                <button id="btn_tweet" class="btn btn-default" type="button">Tweet</button>
                            </span>
                        </form>
                    </div>

                    <div id="tweets" class="list-group">
                    </div>
                </div>
            </div>
			<div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><a href="search_people.php">Procurar pessoas</a></h4>
                    </div>
                </div>
            </div>
		</div>
			
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	</body>
</html>