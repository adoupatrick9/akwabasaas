@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Portefeuille de <span class="text-uppercase">{{ $partenaire['nomComplet'] }}</span>
        <a href="{{ url('/utilisateurs/partenaire') }}" class="btn btn-danger" style="float: right">Retour <i class="fa fa-arrow-left"></i></a>
    </h3>
    <hr>
    <div class="col-md-12 text-center text-success chargeM">
        <h4>Chargement en cours...</h4>
       </div>
    <a data-toggle="modal" href="#myModalStorePortefeuille">
        <div class="btn btn-primary" style="margin-bottom: 10px;">Ajouter au portefeuille  <i class="fa fa-plus"></i></div>
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
                    @foreach($portefeuilles as $portefeuille)
                      <tr>
                        <td class="text-uppercase">{{ $portefeuille['ap_nom_pers'] }} {{ $portefeuille['ap_prenom_pers'] }}</td>
                        <td>{{ $portefeuille['ap_mobile_pers'] }}</td>
                        <td>{{ $portefeuille['ap_email_pers'] }}</td>
                        <td class="center hidden-phone">
                            <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-theme03">Actions</button>
                            <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/utilisateurs-portefeuille-dissocier/'.$IDpartenaire.'/'.$portefeuille['code_rolepersonne']) }}" class="dissocier">Dissocier</a></li>
                                <li><a href="{{ url('/utilisateurs-portefeuille-delete/'.$IDpartenaire.'/'.$portefeuille['code_rolepersonne']) }}"  class="supprimer">Supprimer</a></li>
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
  @include('partenaires.portefeuille-create')
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/portefeuille.js') }}"></script>
@endsection

