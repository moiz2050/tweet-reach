<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Twitter</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{--<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>--}}
        <style>
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }
        </style>
    </head>
    <body>
    <div class="container flex-center position-ref full-height">
        <div class="row">
            <div class="col-lg-12">
                <div class="row"><div class="col-lg-12"> <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('calculate.reach')}}" method="post" class="form-inline">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Enter Tweet url" name="tweetUrl" value="{{ old('tweetUrl') }}">
                            </div>
                            <button type="submit" class="btn-primary btn btn-lg">Submit</button>
                        </form>
                    </div>
                </div></div> </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            @if (session('followersCount'))
                                <h3>{{session('followersCount')}} People reach</h3>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </body>
</html>
