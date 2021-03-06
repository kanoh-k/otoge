<div id="page-title">音ゲーマップ</div>

<?php
$url_reg = Configure::read('url.edit') . '/new';
echo $this->element('search_form');
?>

<div style="text-align:center; margin-top:20px; margin-bottom:20px;">
<a href=<?php echo "'$url_reg'"; ?>>ゲームセンターを新規登録する</a>
</div>

<div class="notification">
<h3>音ゲーマップについて</h3>
<p>
音ゲーマップとは、皆様の情報提供によって作られるゲームセンターの音ゲーに関するデータベースです。<br>
     データベースに登録されていない情報をご存知でしたら、情報を登録していただけるとありがたいです。
</p>
</div>

<div class="notification">
<h3>使い方</h3>
<h4>ゲームセンターを探す</h4>
<ul>
<li>TOPページの検索フォームから、条件を指定して検索してください</li>
<li>検索フォームのタブをクリックすることで、機種ごとに条件を指定して検索することができます</li>
</ul>
<h4>ゲームセンターを新しく登録する</h4>
<ol>
<li>地域や店舗名検索を用いて、ゲームセンターが既に登録されていないかを確認してください。</li>
<li>ゲームセンターが登録されていない場合は、検索フォーム下のリンクから「<a href=<?php echo "'$url_reg'"; ?>>新規登録</a>」ページに移動し、情報を登録してください。</li>
</ol>
<h4>ゲームセンターの情報を編集する</h4>
<ol>
<li>編集したいゲームセンターを検索して、詳細ページを表示してください</li>
<li>詳細ページ下部の「編集する」ボタンをクリックすることで、情報を編集できます</li>
</ol>
</div>

<div class="notification">
<h3>お知らせ</h3>
<h4>2013/05/27</h4>
<ul>
<li>初期データはSDVXのwikiから拝借しています。プログラムの関係で、営業時間の取得ができていません。</li>
<li>機種別検索は現在SDVXのみ実装しています。他機種についても少しずつ実装していく予定です。</li>
<li>デザインのセンスが絶望的…</li>
<li>ご意見やバグ報告等ありましたら、<a href="https://twitter.com/kanoh_k">@kanoh_k</a>までお願いします。</li>
</ul>
</div>