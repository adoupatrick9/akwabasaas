@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Modifier les informations de <span class="text-uppercase">{{ $data['ap_nom_pers'] }} {{ $data['ap_prenom_pers'] }}</span></h3>
    <hr>

    <form action="{{ url('/utilisateurs-update/'.$data['IDas_personne'].'/partenaire') }}" method="POST">
        @csrf
        <div class="col-md-4 form-group">
            Nom <span class="text-danger">*</span><input type="text" name="ap_nom_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_nom_pers'] }}">
        </div>
        <div class="col-md-5 form-group">
            Prénoms <input type="text" name="ap_prenom_pers"  autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_prenom_pers'] }}">
        </div>
        <div class="col-md-3 form-group">
            Login <span class="text-danger">*</span><input type="text" name="ap_login_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_login_pers'] }}">
        </div>
        <div class="tabs">
            <ul class="tabs__items">
                <li class="tabs__item tabs_active">Informations personnelles</li>
                <li class="tabs__item" data-hash="#ill">Coordonnées</li>
            </ul>
            <div class="tabs__content-wrapper">
                <div class="tabs__content tabs_active">
                    <div class="col-md-3 form-group">
                        Type Personne<span class="text-danger">*</span><select name="ap_type_pers" id="ap_type_pers" class="form-control">
                            @if( $data['ap_type_pers']  == 1)
                                <option value="1" selected>physique</option><option value="2">Morale</option>
                            @else
                                <option value="1" >physique</option><option value="2" selected>Morale</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        Genre <span class="text-danger">*</span><select name="ap_genre_pers" id="ap_genre_pers" class="form-control">
                            @if($data['ap_genre_pers'] == "Homme")
                            <option value="Homme" selected>Homme</option><option value="Femme">Femme</option>
                            @else
                            <option value="Homme">Homme</option><option value="Femme" selected>Femme</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        Date de naissance<input type="date" name="ap_datenais_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_datenais_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Lieu de naissance<input type="text" name="ap_lieunai_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_lieunai_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Type pièce <select name="ap_typepiece_pers" id="ap_typepiece_pers" class="form-control">

                            {{ $cni = "", $pass = "", $pc = "", $cr = "", $cs = "", $rcs = "" }}
                            @switch($data['ap_typepiece_pers'])
                                @case("Carte nationale d'identité")
                                    {{ $cni = "selected"}}
                                    @break
                                @case("Passeport")
                                    {{ $pass = "selected"}}
                                    @break
                                @case("Permis de conduire")
                                    {{ $pc = "selected"}}
                                    @break
                                @case("Carte de résident")
                                    {{ $cr = "selected"}}
                                    @break
                                @case("Carte de séjour")
                                    {{ $cs = "selected"}}
                                    @break
                                @case("registre de commerce des sociétés")
                                     {{ $rcs = "selected"}}
                                    @break
                            @endswitch
                            <option {{ $cni }} value="Carte nationale d'identité">Carte nationale d'identité</option>
                            <option {{ $pass }} value="Passeport">Passeport</option>
                            <option {{ $pc }} value="Permis de conduire">Permis de conduire</option>
                            <option {{ $cr }} value="Carte de résident">Carte de résident</option>
                            <option {{ $cs }} value="Carte de séjour">Carte de séjour</option>
                            <option {{ $rcs }} value="registre de commerce des sociétés">registre de commerce des sociétés</option>
                        </select>
                    </div>
                    <input type="number" name="IDas_personne" id="IDas_personne" value="{{ $data['IDas_personne'] }}" class="hidden">
                    <div class="col-md-6 form-group">
                        Numéro pièce <input type="text" name="ap_numeropiece_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_numeropiece_pers'] }}">
                    </div>
                </div>
                <div class="tabs__content" >
                    <div class="col-md-6 form-group">
                        Téléphone mobile <span class="text-danger">*</span><input type="phone" name="ap_mobile_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_mobile_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Téléphone fix<input type="phone" name="ap_telephone_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_telephone_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Email <span class="text-danger">*</span><input type="email" name="ap_email_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_email_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Pays <span class="text-danger">*</span><select name="ap_pays_pers" id="ap_pays_pers" class="form-control">
                            @foreach($pays as $pays)
                                {{ $sel = "" }}
                                @if($pays['LeNomPays'] == $data['ap_pays_pers'])
                                    {{ $sel = "selected" }}
                                @endif
                                <option {{ $sel }} value="{{ $pays['LeNomPays'] }}">{{ $pays['LeNomPays'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        Ville <span class="text-danger">*</span><input type="text" name="ap_ville_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_ville_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Adresse postale<input type="text" name="ap_adressepostale_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_adressepostale_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Adresse géographique<input type="text" name="ap_adressegeo_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_adressegeo_pers'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Site web<input type="text" name="ap_siteweb_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['ap_siteweb_pers'] }}">
                    </div>
                </div>
                <div class="tabs__content">
                </div>
                <div class="modal-footer col-md-12">
                    <a href="{{ url()->previous() }}" class="btn btn-default">Annuler <i class="fa fa-ban"></i></a>
                    <button class="btn btn-theme" type="submit" id="submit">Modifier <i class="fa fa-edit"></i></button>
                </div>
            </div>
        </div>
    </form>
  </section>
@endsection
