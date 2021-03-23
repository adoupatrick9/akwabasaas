@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Les répresentants de <span class="text-uppercase">{{ $user['nomComplet'] }}</span>
        <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right">Retour <i class="fa fa-arrow-left"></i></a>
    </h3>
    <hr>
    <div class="container">
      @if(session()->has('message'))
          <h4 class="alert alert-info text-center">{{ session()->get('message') }}</h4>
      @endif
    </div>
    <a data-toggle="modal" href="#myModalStoreRepresentant">
        <div class="btn btn-primary" style="margin-bottom: 10px;">Ajouter un représentant  <i class="fa fa-plus"></i></div>
    </a>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
            <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                  <thead>
                    <tr>
                        <th>Nom complet</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($representants as $representant)
                      <tr>
                        <td class="text-uppercase">{{ $representant['ap_nom_pers'] }}</td>
                        <td>{{ $representant['ap_mobile_pers'] }}</td>
                        <td>{{ $representant['ap_email_pers'] }}</td>
                        <td class="center hidden-phone">
                                <!-- Split button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme03">Actions</button>
                                <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/utilisateurs-representant-dissocier/'.$representant['code_representant']) }}" class="dissocier">Dissocier</a></li>
                                    <li><a href="{{ url('/utilisateurs-representant-delete/'.$representant['code_representant']) }}" id="{{ $representant['idas_representant'] }}" class="supprimer">Supprimer</a></li>
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
  @include('utilisateurs/representant-create')
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/representant.js') }}"></script>
@endsection

