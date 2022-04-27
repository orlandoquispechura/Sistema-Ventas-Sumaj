@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <div class=""><img style="width: 200px;" src="imagen/logo-sumaj1.png" alt="sumaj-alt">
    </div>
    <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 20px;">Bienvenido al sistema de ventas Sumaj st</h4>
    <hr>
@stop

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body" style="background-color: #f5927433;">
                {{-- <div class="row mt-5"> --}}
                <div class="col-md-12">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active justify-content-center" styl data-bs-interval="2500">
                                <img src="imagen/panasonic.png" class="d-block img-fluid" width="40%" title="panasonic" alt="Imagen-Panasonic">
                            </div>
                            <div class="carousel-item" styl data-bs-interval="2500">
                                <img src="imagen/Crown.png" class="d-block img-fluid" width="40%" title="crown" alt="Imagen-Crown">
                            </div>
                            <div class="carousel-item" styl data-bs-interval="2500">
                                <img src="imagen/forza01.png" class="d-block img-fluid" width="40%" title="forza" alt="Imagen-Forza">
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
@stop
