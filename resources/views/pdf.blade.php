<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PDF</title>
<style>
@font-face{
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src:url('{{ storage_path('fonts/ipag.ttf')}}');
}
body {
font-family: ipag;
}
table{
    border-collapse: collapse;
}
thead {
    width: 100%;
}
tr {
    margin: 0 auto;
}
th {
    margin: 0;
    border: 1px solid black;
}
td {
    border: 1px solid black;
}
.container{
    /* background-color: aqua; */
    width: 100%;   
}
.name {
    width: 200px;
}
.price{
    width: 140px;
}
.memo{
    width: 343px;
}
.check{
    width: 20px;
}

</style>
</head>
<body>
    <div class="container">
        @foreach ($layaways as $key => $performer)
        @if ($key == 0)
            <h2 class="performer">{{$performer->performer_name}}の取り置きリスト</h2>
            @break
        @endif
        @endforeach
        <table>
            <thead>
                <tr>
                    <th class="name">氏名</th>
                    <th class="price">料金</th>
                    <th class="memo">備考</th>
                    <th class="check">check</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layaways as $item)
                <tr>
                    <td>{{$item->user->name}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>