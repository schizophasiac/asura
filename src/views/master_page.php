<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?=$this->description?>
    <title><?=$this->title?></tile>
    <?=$this->stylesheets?>
    <?=$this->javascripts?>
</head>
<body lang="en">
<div id="obody">
    <div id="ibody">
        <div id="header">
            <a href="<?=$this->siteUrl?>">
                <div id="branding">
                    <h1><span id="title"><?=$this->pageTitle?></span></h1>
                    <h2><span id="subtitle"><?=$this->subtitle?></span></h2>
                </div>
            </a>
        </div>
        <div id="main">
            <div id="mainMenu">
                <?=$this->mainMenu?>
            </div>
            <div id="container">
                <div id="content">
                    <?=$this->messages?>
                    <?=$this->content?>
                </div>
            </div>
        </div>
        <div id="footer">
            <div id="siteinfo">
                <?=$this->siteInfo?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
