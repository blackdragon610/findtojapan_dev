<tr class="tr">
    <th class="th" style="width:20%">日本語表記</th>
    <td class="td" style="width:30%">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'user_name', 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th" style="width:20%">英語表記</th>
    <td class="td" style="width:30%">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'user_name_english', 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">ジャンル</th>
    <td class="td">
        @include('layouts.parts.editor.select', ['name' => 'genre', "file" => configJson("company_genre"), "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">カテゴリ</th>
    <td class="td">
        @include('layouts.parts.editor.select', ['name' => 'category', "file" => configJson("company_category"), "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">店舗のPR</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.textarea', ['name' => 'pr', 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">住所</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'address', 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>
<tr class="tr">
    <th class="th">URL</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "url", 'name' => 'url', 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">電話番号</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "tel", 'name' => 'tel', 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>
<tr class="tr">
    <th class="th">営業時間(開始)</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'time_open', 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">営業時間(終了)</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'time_close', 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>
<tr class="tr">
    <th class="th">定休日</th>
    <td class="td">
        @include('layouts.parts.editor.checkbox', ['name' => 'holidays', "file" => configJson("week"), "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">開催日</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "date", 'name' => 'date_open', 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>
<tr class="tr">
    <th class="th">セクシャリティ</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'gender', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">スタッフ</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'staff', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>
<tr class="tr">
    <th class="th">メニュー</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.textarea', ['name' => 'menu', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">Twitter</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.text', ["type" => "url", 'name' => 'twitter', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">Facebook</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.text', ["type" => "url", 'name' => 'facebook', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">instagram</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.text', ["type" => "url", 'name' => 'instagram', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">席数</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'seats', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">収容人数</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'containment', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>
<tr class="tr">
    <th class="th">部屋数</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'room', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">個室数</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'private_room', "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">オプション</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.checkbox', ['name' => 'options', "file" => configJson("company_option"), "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>

<tr class="tr">
    <th class="th">メイン画像</th>
    <td class="td">
        @include('layouts.parts.editor.file', ['name' => 'image', "type" => "image", "uploadType" => getUploadType("Company"), 'contents' => 'class="form-control" placeholder=""'])
    </td>

    @for ($i = 1; $i <= 8; $i++)
        @if (($i % 2 == 1))
        @else
</tr>
<tr class="tr">
    @endif
    <th class="th">追加画像{{$i}}</th>
    <td class="td">
        @include('layouts.parts.editor.file', ['name' => 'image_add' . $i, "type" => "image", "uploadType" => getUploadType("Company"), 'contents' => 'class="form-control" placeholder=""'])
    </td>
@endfor

<tr class="tr">
    <th class="th">動画</th>
    <td class="td" colspan="3">
        @include('layouts.parts.editor.file', ['name' => 'movie', "type" => "string", "uploadType" => getUploadType("Company"), 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>



<tr class="tr">
    <th class="th">ログインID</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'login_id', 'contents' => 'class="form-control" placeholder=""'])
    </td>
    <th class="th">パスワード<br />(半角英数字の大文字と小文字と数字と記号を一つ以上)</th>
    <td class="td">
        @include('layouts.parts.editor.text', ["type" => "password", 'name' => 'password', 'contents' => 'class="form-control" placeholder=""'])
    </td>
</tr>
