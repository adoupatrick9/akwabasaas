@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Le solde de <span class="text-uppercase">{{ $utilisateur['nomComplet'] }}</span> est <span class="text-danger">{{ $compte['cpt_solde'] }} F CFA</span>
        <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right">Retour <i class="fa fa-arrow-left"></i></a>
    </h3>
    <hr>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
            <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
                <h3>Liste des mouvements</h3>
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                  <thead>
                    <tr>
                        <th>Intitulé</th>
                        <th>Montant entré</th>
                        <th>Montant sorti</th>
                        <th>Solde progressif</th>
                        <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($mouvements as $mouvement)
                      <tr>
                        <td class="text-uppercase">{{ $mouvement['mv_intitule'] }}</td>
                        <td>{{ $mouvement['mv_montant_entre'] }}</td>
                        <td>{{ $mouvement['mv_montant_sortie'] }}</td>
                        <td>{{ $mouvement['mv_solde_progressif'] }}</td>
                        <td>{{ $mouvement['mv_date'] }}</td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
        </div>
        <!-- page end-->
      </div>
  </section>
@endsection
