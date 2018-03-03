@extends('layouts.app')
<STYLE>
    .list-group1{
        overflow-y: scroll;
        height: 200px;
    }
</STYLE>

@section('content')

<body xmlns:v-on="http://www.w3.org/1999/xhtml">
<br>

    <div class="container">
        <div class="row" id="app">
            <h1></h1>
            <div class="offset-4 col-4 offset-sm-1 col-sm-8">

                <li class="list-group-item active">Chat Group<small class="badge badge-pill badge-danger">@{{ onlineUser }}</small></li>
                <ul class="list-group1" v-chat-scroll>
                    <message v-for="value,index in chat.message"
                             :key=value.index
                             :color=chat.color[index]
                             :user=chat.user[index]
                             :side=chat.side[index]
                             :time=chat.time[index]
                    >@{{value}}</message>
                </ul>
                <div class="badge badge-pill badge-info">@{{ typeing }}</div>
                <input type="text" class="form-control" placeholder="Type your message here...."
                       v-model="message" v-on:keyup.enter="send"/>
            </div>
        </div>
    </div>
</body>

@endsection
