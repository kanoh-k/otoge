<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title>SOUND VOLTEX ヒットチャート</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<?php
echo $this->Html->css('otomap');
// echo $this->Html->script('jquery');
echo $this->Html->script('jquery.tablesorter');
echo $this->Html->script('otomap');
$this->start('script');
?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-41234016-1', 'sakura.ne.jp');ga('send', 'pageview');
</script>
<?php
$this->end();
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
// echo $scripts_for_layout;    

$url_top = Configure::read('url.top');
$url_otomap = Configure::read('url.otomap');
$url_sdvxrank = Configure::read('url.sdvxrank');
?>
</head>
<body>
<div id="container">
    <div id="header">
    <table id="header_menu"><tr>
    <?php echo "<td><a href='$url_top'>TOP</a></td>"?>
    <?php echo "<td><a href='$url_otomap'>音ゲーマップ</a></td>"?>
    <?php echo "<td><a href='$url_sdvxrank'>SDVXランキング</a></td>"?>
    </tr></table>
    </div>
    <div id="content">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="footer">
<?php echo $this->element('social_btn'); ?>
    <a href=<?php echo "\"$url_sdvxrank\"" ?>>SDVX ヒットチャートのTOPへ戻る</a> <br>
    <div class="footer-message">
    ランキングデータは公式サイトの<a href="http://p.eagate.573.jp/game/sdvx/ii/p/hitchart/index.html" target="_blank">ヒットチャートページ</a>から取得しています
    </div>
    </div>
	</div>
</body>
</html>
