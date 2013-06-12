<?php
$url_otomap = Configure::read('url.otomap');
$url_sdvxrank = Configure::read('url.sdvxrank');
?>

<div id="page-title">音ゲー的集合知</div>

<div class="notification">
<h3>コンテンツ</h3>
<ul>
    <li><a href=<?php echo "'$url_otomap'"; ?>>音ゲーマップ(ゲームセンター検索)</a></li>
<li><a href=<?php echo "'$url_sdvxrank'"; ?>>SOUND VOLTEX ヒットチャート</a></li>
</ul>
</div>

<div class="notification">
<h3>当サイトについて</h3>
<p>
当サイトは現在「音ゲーマップ」と「SDVXランキング」の2つのコンテンツを公開しています。<br>
音ゲーマップは全国の音ゲー筐体を検索できるシステム、SDVXランキングはSDVXの過去のヒットチャートを見返すためのツールです。<br>
今後も趣味全開で思いついたことを飽きるまで実装していく予定です。
</p>
</div>

<div class="notification">
<h3>お知らせ</h3>
<h4>2013/06/13</h4>
<ul>
<li>試験的にSOUND VOLTEXヒットチャートを公開しました</li>
</ul>
<h4>2013/05/27</h4>
<ul>
<li>初期データはSDVXのwikiから拝借しています。プログラムの関係で、営業時間の取得ができていません。</li>
<li>機種別検索は現在SDVXのみ実装しています。他機種についても少しずつ実装していく予定です。</li>
<li>デザインのセンスが絶望的…</li>
</ul>
</div>

<div class="notification">
<h3>連絡先</h3>
<p>ご意見やバグ報告等ありましたら、<a href="https://twitter.com/kanoh_k">@kanoh_k</a>までお願いします。</p>
</div>