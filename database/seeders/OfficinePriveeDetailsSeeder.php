<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficinePriveeDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $details = [
            ['title' => 'PROCEDURE DE CREATION D\'OFFICINE PRIVEE', 'content' => '', 'type' => 'h2', 'order' => 1],
            ['title' => 'AGREMENT POUR UNE PHARMACIE D’OFFICINE PRIVEE', 'content' => '', 'type' => 'h5', 'order' => 2],
            ['title' => '', 'content' => 'La création d’une pharmacie d’officine est l’acte par lequel le Ministre de la santé accorde l’autorisation à une personne physique de gérer et exploiter à son propre compte une pharmacie, suite à un ensemble de procédures.', 'type' => 'p', 'order' => 3],
            ['title' => '', 'content' => 'La procédure a pour objet d’apporter les informations essentielles aux soumissionnaires, en vue d’éviter les rejets préjudiciables au traitement accéléré de leurs dossiers.', 'type' => 'p', 'order' => 4],
            ['title' => '', 'content' => 'Nul ne peut exercer la profession de pharmacien en République de Guinée, s’il ne présente toutes les garanties de bonne moralité professionnelle et s’il ne remplit les conditions suivantes cf article 75 du décret D/2018/111/PRGR du 13 juillet 2018:', 'type' => 'p', 'order' => 5],
            ['title' => '', 'content' => 'Etre titulaire du diplôme d’Etat national de Docteur en pharmacie ou d’un diplôme de pharmacien reconnu équivalent par les autorités nationales', 'type' => 'li', 'order' => 6],
            ['title' => '', 'content' => 'Les autres principes sont identiques à ceux définis pour l’ensemble des Établissements pharmaceutiques (voir agrément pour société grossiste).', 'type' => 'li', 'order' => 7],
            ['title' => '', 'content' => 'La demande de l’intéressé ;', 'type' => 'li', 'order' => 8],
            ['title' => '', 'content' => 'La copie du diplôme ;', 'type' => 'li', 'order' => 9],
            ['title' => '', 'content' => 'L’extrait de l’acte de naissance ;', 'type' => 'li', 'order' => 10],
            ['title' => '', 'content' => 'Casier judiciaire ;', 'type' => 'li', 'order' => 11],
            ['title' => '', 'content' => 'Certificat de nationalité ;', 'type' => 'li', 'order' => 12],
            ['title' => '', 'content' => 'Curriculum vitae ;', 'type' => 'li', 'order' => 13],
            ['title' => '', 'content' => 'Quatre photos d’identité ;', 'type' => 'li', 'order' => 14],
            ['title' => '', 'content' => 'Deux enveloppes timbrées libellées à l’adresse du demandeur ;', 'type' => 'li', 'order' => 15],
            ['title' => '', 'content' => 'Attestation d’inscription à l’ordre des pharmaciens ;', 'type' => 'li', 'order' => 16],
            ['title' => '', 'content' => 'Attestation d’exercice d’au moins cinq (5) ans dans le privé.', 'type' => 'li', 'order' => 17],
            ['title' => '', 'content' => 'L’avis motivé du Directeur communal ou préfectoral de la santé ;', 'type' => 'li', 'order' => 18],
            ['title' => '', 'content' => 'Pièce justifiant la propriété du local ou le contrat de bail ;', 'type' => 'li', 'order' => 19],
            ['title' => '', 'content' => 'Fiche de localisation remplie et visée par le pharmacien inspecteur ;', 'type' => 'li', 'order' => 20],
            ['title' => '', 'content' => 'Plan de masse du site, visé par le cadastre.', 'type' => 'li', 'order' => 21],
            ['title' => 'DELAI DE TRAITEMENT', 'content' => '', 'type' => 'h6', 'order' => 22],
            ['title' => 'Analyse de recevabilité par la Division EBP', 'content' => '06 jours', 'type' => 'delai', 'order' => 23],
            ['title' => 'Examen par la commission des agréments', 'content' => '60 jours', 'type' => 'delai', 'order' => 24],
            ['title' => 'Examen par l’Ordre des pharmaciens et l’IGS', 'content' => '30 jours', 'type' => 'delai', 'order' => 25],
            ['title' => 'Établissement du projet d’agrément', 'content' => '30 jours', 'type' => 'delai', 'order' => 26],
            ['title' => 'Établissement du projet d’agrément', 'content' => '126 jours', 'type' => 'delai', 'order' => 27],
        ];

        DB::table('infor_officine')->insert($details);
    }
}
