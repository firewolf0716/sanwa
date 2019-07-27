適時カスタム投稿のスラッグの書き換えが必要

works_func.phpは投稿タイプがworksのときここに書きこんだりする
適時タイプ名で変更や追加する


このディレクトリのファイルはfunctions.phpに読み込む処理を書かなければいけない
例
require_once locate_template('lib/custom_post_func.php');
