<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>勤怠管理アプリ</title>
</head>
<body>
    <script>
        setInterval(()=>{
    let now =new Date();
    let HourValue=now.getHours();
    let FormattedHour=String(HourValue).padStart(2,'0');
    let MinutesValue=now.getMinutes();
    let FormattedMinutes=String(MinutesValue).padStart(2,'0');
    let SecondValue=now.getSeconds();
    let FormattedSecond=String(SecondValue).padStart(2,'0');
    let msg=FormattedHour+":"+FormattedMinutes+":"+FormattedSecond;
    document.getElementById("dateTimeDisp").innerHTML=msg;
},1000);
    </script>
        <!--@if(session('modalContent'))
    //     <script>
    //     window.onload=()=>{
    //         let result=confirm('前回の打刻から日付が変わっています。このまま打刻しますか？');
    //         if (result) {
    //             //postへ
    //         }
    //     };
    //     </script>
    @endif
-->
    <h1 class="text-center text-5xl Hiragino Sans mt-8">勤怠管理アプリ</h1>
    @if (session('alertMessage'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4 w-80 text-center mx-auto" role="alert">
            {{ session('alertMessage') }}
        </div> 
    @endif
    <div class="text-center mt-4 text-4xl">
        <span id="dateTimeDisp"></span>
    </div class="text-center">
    <div class="text-center mt-4 text-2xl ">
        @if (session('workState'))
            {{session('workState')}}
        @endif
    </div>
    <div class="text-center mt-4 text-3xl ">
        <form method="post" action="{{route('post.store')}}">@csrf
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded w-480">出勤</button>
        </form>
    </div>
    <div class="text-center mt-4 text-3xl">
        <form method="post" action="{{route('post.secondStore')}}">@csrf
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">休憩開始</button>
        </form>
    </div>
    <div class="text-center mt-4 text-3xl">
        <form method="post" action="{{route('post.thirdStore')}}">@csrf
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">休憩終了</button>
        </form>
    </div>
    <div class="text-center mt-4 text-3xl">
        <form method="post" action="{{route('post.fourthStore')}}">@csrf
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">退勤</button>
        </form>
    </div>

    <script type="module"src="../js/time.js">
        // const modal=document.querySelector('dialog');
        // modal.addEventListener('load',()=>{
        //     let result=comfirm('前回の打刻から日付が変わっています。このまま打刻しますか？');
        //     if (result) {
        //         alert('postへ送信');
        //     }else{
        //         alert('キャンセルしました。');
        //     }
        // });
    </script>
</body>
</html>
