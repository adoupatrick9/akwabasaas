@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Service(s) souscrit(s) par <span class="text-uppercase">{{ $NomClient }}</span>
        <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right">Retour <i class="fa fa-arrow-left"></i></a>
    </h3>
    <hr>
    <div class="container">
      @if(session()->has('message'))
          <h4 class="alert alert-info text-center">{{ session()->get('message') }}</h4>
      @endif
    </div>

    <a data-toggle="modal" href="{{ URL::current().'#myModalStore' }}">
        <div class="btn btn-primary" style="margin: 10px 0px;">Ajouter un service au client  <i class="fa fa-plus"></i></div>
    </a>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
            <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                  <thead>
                    <tr>
                      <th >Service</th>
                      <th>Type</th>
                      <th>Inactif</th>
                      <th>Date souscription</th>
                      <th class="hidden-phone">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ServicesClient as $ServicesClient)
                      <tr>
                        <td style="vertical-align: middle;" class="text-uppercase">{{ $ServicesClient['Sce_nom_service'] }}</td>
                        <td style="vertical-align: middle;">
                            @switch($ServicesClient['Sce_type_service'] )
                                @case(1)
                                    Saas
                                    @break
                                @case(2)
                                    One premise
                                    @break
                            @endswitch
                        </td>
                        <td style="vertical-align: middle;" class="center">
                            @if($ServicesClient['sc_inactif'] == true)
                                <img src="{{ asset('img/ok.png') }}" alt="ok" width="25" height="25">
                            @endif
                        </td>
                        <td style="vertical-align: middle;">{{ $ServicesClient['sc_date_souscription'] }}</td>
                        <td class="center hidden-phone">
                                <!-- Split button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-theme03">Actions</button>
                                    <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/services-client-actif-inactif/'.$ServicesClient['IDas_service_client'].'/'.$IDclient)  }}">Activer/Désactiver</a></li>
                                        <li><a href="{{ url('/services-client-delete/'.$ServicesClient['IDas_service_client'].'/'.$IDclient)  }}">Supprimer</a></li>
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
  </section>
  @include('services-client.affecter')
@endsection

