<?php
require "example-runner/utils.php";
?>
<!DOCTYPE html>
<html class="height-100">

<head>
    <title>ag-Grid Data Grid Example</title>
    <meta name="description"
          content="Example of using ag-Grid demonstrating that it can work very fast with thousands of rows.">
    <meta name="keywords" content="react angular angularjs data grid example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="./style.css">

    <style>
        label {
            font-weight: normal !important;
        }

        .blue {
            background-color: darkblue;
            color: lightblue;
        }

        .ag-theme-fresh .good-score {
            background-color: rgba(0, 200, 0, 0.4)
        }

        .ag-theme-blue .good-score {
            background-color: rgba(0, 200, 0, 0.4)
        }

        .ag-theme-dark .good-score {
            background-color: rgba(0, 100, 0, 0.4)
        }

        .ag-theme-fresh .bad-score {
            background-color: rgba(200, 0, 0, 0.4)
        }

        .ag-theme-blue .bad-score {
            background-color: rgba(200, 0, 0, 0.4)
        }

        .ag-theme-dark .bad-score {
            background-color: rgba(100, 0, 0, 0.4)
        }

        button[disabled] {
            opacity: 0.5;
        }

        .ag-theme-dark .star {
            filter: invert(100%);
            -webkit-filter: invert(100%);
            -moz-filter: invert(100%);
            -ms-filter: invert(100%);
        }

        .ag-theme-material .good-score {
            background-color: rgba(185,246,202 , 0.4);
        }

        .ag-theme-material .bad-score {
            background-color: rgba(255,128,171 , 0.4);
        }
    </style>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="https://www.ag-grid.com/favicon.ico"/>

    <?= globalAgGridScript(true) ?>

    <script src="example.js"></script>

</head>

<body style="height: 100%; margin: 0px; padding: 0px;">

<!-- The table div -->
<div style="padding-top: 98px; height: 100%; width: 100%;">
    <div id="myGrid" style="height: 100%; overflow: hidden;" class="ag-theme-fresh"></div>
</div>

<div class="header-row" style="position: fixed; top: 0px; left: 0px; width: 100%; padding-bottom: 0px;">

    <?php $navKey = "demo";
    include 'includes/navbar.php'; ?>

    <div class="container">

        <div class="row">
            <div class="col-md-9">

                <div style="padding: 5px 5px 6px 5px;">

                    <!-- First row of header, has table options -->
                    <div style="padding: 4px;">
                        <input placeholder="Filter..." type="text"
                               oninput="onFilterChanged(this.value)"
                               ondblclick="filterDoubleClicked(event)"
                               class="hide-when-small"
                               style="color: #333; width: 150px;"
                        />

                        <span style="padding-left: 20px;">Data Size:</span>
                        <select onchange="onDataSizeChanged(this.value)"
                                style="color: #333;">
                            <option value=".1x22">100 Rows, 22 Cols</option>
                            <option value="1x22">1,000 Rows, 22 Cols</option>
                            <option value="10x100">10,000 Rows, 100 Cols</option>
                            <option value="100x22">100,000 Rows, 22 Cols</option>
                        </select>

                        <span style="padding-left: 20px;" class="hide-when-small">Theme:</span>

                        <select onchange="onThemeChanged(this.value)" style="width: 90px; color: #333;"
                                class="hide-when-small">
                            <option value="">-none-</option>
                            <option value="ag-theme-material">Material</option>
                            <option value="ag-theme-fresh" selected>Fresh</option>
                            <option value="ag-theme-dark">Dark</option>
                            <option value="ag-theme-blue">Blue</option>
                        </select>

                        <span id="message" style="margin-left: 10px;">
                                    <i class="fa fa-spinner fa-spin"></i>
                                    <span id="messageText"></span>
                                </span>

                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <a href="#" class="videoLink pull-right text-right" data-toggle="modal" data-target="#videoModal">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                         <path style="fill:#D8362A;"
                               d="M506.703,145.655c0,0-5.297-37.959-20.303-54.731c-19.421-22.069-41.49-22.069-51.2-22.952
                                  C363.697,62.676,256,61.793,256,61.793l0,0c0,0-107.697,0.883-179.2,6.179c-9.71,0.883-31.779,1.766-51.2,22.952
                                  C9.71,107.697,5.297,145.655,5.297,145.655S0,190.676,0,235.697v41.49c0,45.021,5.297,89.159,5.297,89.159
                                  s5.297,37.959,20.303,54.731c19.421,22.069,45.021,21.186,56.497,23.835C122.703,449.324,256,450.207,256,450.207
                                  s107.697,0,179.2-6.179c9.71-0.883,31.779-1.766,51.2-22.952c15.007-16.772,20.303-54.731,20.303-54.731S512,321.324,512,277.186
                                  v-41.49C512,190.676,506.703,145.655,506.703,145.655"/>
                        <polygon style="fill:#FFFFFF;" points="194.207,166.841 194.207,358.4 361.931,264.828 "/>
                    </svg>
                    Take video tour</a>
            </div>
        </div>

    </div>

</div>

<script>
    function closeVideo(id) {
        // stop the video (otherwise would continue to play int he background)
        let youTubeVideo = document.getElementById(id);
        youTubeVideo.src = youTubeVideo.src;
    }
</script>
<!-- The Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
    <div class="modal-dialog" style="width: 887px;">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close videoClose" onclick="closeVideo('tsuhoLiSWmU')" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div style="padding-top: 30px">
                    <iframe width="100%" id="tsuhoLiSWmU" height="315" src="https://www.youtube.com/embed/tsuhoLiSWmU?version=3&enablejsapi=1" frameborder="0"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<?php include_once("includes/analytics.php"); ?>

</html>
