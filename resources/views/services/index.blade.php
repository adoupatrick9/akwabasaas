@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Services</h3>
    <hr>
    <div class="container">
        @if(session()->has('message'))
            <h4 class="alert alert-info text-center">{{ session()->get('message') }}</h4>
        @endif
    </div>

    <a data-toggle="modal" href="{{ url('/services#myModalStore') }}">
        <div class="btn btn-primary" style="margin: 10px 0px;">Ajouter un service  <i class="fa fa-plus"></i></div>
    </a>

    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Inactif</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                        <td style="vertical-align: middle;">{{ $service['Sce_nom_service'] }}</td>
                        <td style="vertical-align: middle;">
                            @switch($service['Sce_type_service'] )
                            @case(1)
                                Saas
                                @break
                            @case(2)
                                One premise
                                @break
                        @endswitch
                        </td>
                        <td style="vertical-align: middle;" class="center">
                            @if($service['sce_inactif'] == true)
                                <img src="{{ asset('img/ok.png') }}" alt="ok" width="25" height="25">
                           @endif
                        </td>
                        <td class="center">
                                <!-- Split button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme03">Actions</button>
                                <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/services-edit/'.$service['IDas_service']).'/services' }}">Modifier</a></li>
                                    <li><a href="{{ url('/services-actif-inactif/'.$service['IDas_service']) }}">Activer/Désactiver</a></li>
                                    <li><a href="{{ url('/services-delete/'.$service['IDas_service'] ) }}">Supprimer</a></li>
                                </ul>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
        </div>
        <!-- page end-->
      </div>

    @include('services.create')
  </section>
@endsection
