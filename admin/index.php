<?php include("includes/header.php"); ?>

<?php if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); } ?>
    
    <div class="pusher">

        <!-- Page Heading -->
        <div class="ui container">

            <h3 class="ui horizontal divider large header">DASHBOARD</h3>
            <div class="ui space hidden divider"></div>

            <div class="ui four column doubling stackable grid">

                <div class="center aligned column">
                    <div class="ui blue fluid link card">

                        <div class="center aligned content">
                            <div class="ui statistic">
                                <h1 class="ui massive icon header"><i class="eye very big icon"></i></h1>
                                <div class="ui horizontal divider blue basic massive header">VIEWS</div>
                                <div class="value"><?=$session->count?></div>
                            </div>
                        </div>

                        <div class="extra content">
                            <a>New Views <i class="right chevron icon"></i></a>
                        </div>
                    </div>
                </div>

                <div class="center aligned column">
                    <div class="ui green fluid link card">

                        <div class="content">
                            <div class="ui statistic">
                                <h1 class="ui massive icon header"><i class="photo very big icon"></i></h1>
                                <div class="ui horizontal divider green basic massive header">PHOTOS</div>
                                <div class="value"><?=Photo::countRecords()?></div>
                            </div>
                        </div>

                        <div class="extra content">
                            <a href="<?=ADMIN?>photos.php">All Photos<i class="right chevron icon"></i></a>
                        </div>
                    </div>
                </div>


                <div class="center aligned column">
                    <div class="ui orange fluid link card">

                        <div class="content">
                            <div class="ui statistic">
                                <h1 class="ui massive icon header"><i class="users very big icon"></i></h1>
                                <div class="ui horizontal divider orange basic massive header">USERS</div>
                                <div class="value"><?=User::countRecords()?></div>
                            </div>
                        </div>

                        <div class="extra content">
                            <a href="<?=ADMIN?>users.php">All Users<i class="right chevron icon"></i></a>
                        </div>
                    </div>
                </div>


                <div class="center aligned column">
                    <div class="ui red fluid link card">

                        <div class="content">
                            <div class="ui statistic">
                                <h1 class="ui massive icon header"><i class="comments very big icon"></i></h1>
                                <div class="ui horizontal divider red basic massive header">COMMENTS</div>
                                <div class="value"><?=Comment::countRecords()?></div>
                            </div>
                        </div>

                        <div class="extra content">
                            <a href="<?=ADMIN?>comments.php">All Comments<i class="right chevron icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui hidden divider"></div>

            <div class="ui container">
                <div id="piechart" style="min-width: 900px; min-height: 500px;"></div>
            </div>

        </div>
    
    <script type="text/javascript">
        
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Info', 'Charts'],
                ['Site Visits',  <?=$session->count?>],
                ['Comments',  <?=Comment::countRecords()?>],
                ['Users', <?=User::countRecords()?>],
                ['Photos', <?=Photo::countRecords()?>]
            ]);

            var options = {
                legend: 'none',
                pieSliceText: 'label',
                pieStartAngle: 100,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            
            chart.draw(data, options);
        }
        
    </script>

<?php include("includes/footer.php"); ?>