@extends('layouts.theme')

@section('content')

        <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Configurations</h3>
          <div class="col-md-12 text-center text-success chargeM">
            <h4>Chargement en cours...</h4>
           </div>
          <div class="row mt">
            <div class="col-lg-6">
              <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Liste des devises</h4>

                <section id="unseen" style="margin-left: 10px; margin-right: 10px;">
                    <hr>
                    <button class="btn btn-primary addDevise" style="margin-bottom: 10px;">Ajouter une devise  <i class="fa fa-plus"></i></button>
                  <table class="table table-bordered table-striped table-condensed" >
                    <thead>
                      <tr>
                        <th width="20%">Devise</th>
                        <th width="10%">Actions</th>
                      </tr>
                    </thead>
                    <tbody >
                        @foreach($devises as $devise)
                            <tr>
                                <td class="text-uppercase">{{ $devise['Dev_intitule_devise'] }}</td>
                                <td class="center">
                                    <!-- Split button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-theme03">Actions</button>
                                    <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" id="{{ $devise['IDas_devise'] }}" class="editer">Modifier</a></li>
                                        <li><a href="#" id="{{ $devise['IDas_devise'] }}" class="supprimer">Supprimer</a></li>
                                    </ul>
                                </div>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </section>
              </div>
              <!-- /content-panel -->
            </div>
        </section>

        @include('devises.create')
        @include('devises.edit')

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/devise.js') }}"></script>
@endsection
