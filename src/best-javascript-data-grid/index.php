<?php
$key = "Overview JavaScript";
$pageTitle = "JavaScript Datagrid";
$pageDescription = "ag-Grid can be used as a data grid inside your plain JavaScript application. This page details how to get started.";
$pageKeyboards = "JavaScript Datagrid";
$pageGroup = "basics";
include '../documentation-main/documentation_header.php';
?>

    <div>

        <h1 class="first-h1">
            <img style="vertical-align: middle" src="/images/svg/javascript.svg" height="50px"/>
            JavaScript Grid
        </h1>

        <p>
            Here we describe how to get ag-Grid up an running inside a plain JavaScript application.
            The section is broken down into the following:
        </p>

        <div class="list-group" style="margin-top: 50px; margin-bottom: 50px;">
            <a href="/javascript-getting-started/" class="list-group-item">
                <div class="float-parent">
                    <div class="section-icon-container">
                        <img src="../images/svg/docs/getting_started.svg" width="50" />
                    </div>
                    <h4 class="list-group-item-heading">Getting Started</h4>
                    <p class="list-group-item-text">
                        Learn how to get a simple application working using ag-Grid and JavaScript.
                        Start here to get a simple grid working in your application, then follow on
                        to further sections to understand how particular features work.
                    </p>
                </div>
            </a>
            <a href="/javascript-more-details/" class="list-group-item">
                <div class="float-parent">
                    <div class="section-icon-container">
                        <img src="../images/svg/docs/more-details2.svg" width="50" />
                    </div>
                    <h4 class="list-group-item-heading">More Details</h4>
                    <p class="list-group-item-text">
                        Dive deeper in how to use ag-Grid with JavaScript, including referencing dependencies
                        and an overview on interfacing.
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div style="text-align: center;">
        <h2>Feature Roadshow</h2>
    </div>

    <?php
    $featuresRoot = '../javascript-grid-features';
    include '../javascript-grid-features/gridFeatures.php';
    ?>


<?php include '../documentation-main/documentation_footer.php'; ?>

