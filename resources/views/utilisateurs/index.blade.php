@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Utilisateurs</h3>
    <hr>
    <div class="col-md-12 text-center text-success chargeM">
        <h4>Chargement en cours...</h4>
    </div>
    <a data-toggle="modal" href="#myModalStoreUtilisateur">
        <div class="btn btn-primary" style="margin-bottom: 10px">Ajouter un utilisateur  <i class="fa fa-plus"></i></div>
    </a>

    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Login</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Inactif</th>
                    <th class="hidden-phone">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $user)
                        <tr>
                            <td style="vertical-align: middle;">{{ $user['ap_login_pers'] }}</td>
                            <td style="vertical-align: middle;" class="text-uppercase">{{ $user['nomComplet'] }}</td>
                            <td style="vertical-align: middle;">{{ $user['ap_email_pers'] }}</td>
                            <td style="vertical-align: middle;">{{ $user['ap_mobile_pers'] }}</td>
                            <td style="vertical-align: middle;" class="center">
                                @if($user['ap_inactif'] == true)
                                    <img src="{{ asset('img/ok.png') }}" alt="ok" width="25" height="25">
                                @endif
                            </td>
                            <td class="center hidden-phone">
                                    <!-- Split button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-theme03">Actions</button>
                                    <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" id="{{ $user['idas_personne'] }}" class="editer">Modifier</a></li>
                                        <li><a href="{{ url('/utilisateurs-actif-inactif/'.$user['idas_personne'].'/utilisateur' ) }}">Activer/Désactiver</a></li>
                                        <li><a href="#" id="{{ $user['idas_personne'] }}" class="supprimer">Supprimer</a></li>
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

    @include('utilisateurs.create')
    @include('utilisateurs.edit')

</section>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/utilisateur.js') }}"></script>
@endsection
