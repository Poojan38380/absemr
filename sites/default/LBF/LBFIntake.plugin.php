<?php

function LBFIntake_javascript_onload()
{
    echo "
       const living = document.getElementById('form_apartment_no_intake');
       living.style.display = 'none';
       const threequater = document.getElementById('form_three_qtr_intake');
       threequater.style.display = 'none';
       const halfway = document.getElementById('form_name_halfway_intake');
       halfway.style.display = 'none';
       const treatment = document.getElementById('form_Name_of_Residential_Treatment_P');
       treatment.style.display = 'none';
       const shelter = document.getElementById('form_Name_of_Shelter');
       shelter.style.display = 'none';
       
       document.getElementById('form_homeless_intake').addEventListener('change', displayLiving);
       function displayLiving() {
           l = document.getElementById('form_homeless_intake').value;
           if (l == 'apartment') {
              living.style.display = 'block';
              threequater.style.display = 'none';
              halfway.style.display = 'none';
              treatment.style.display = 'none';
              shelter.style.display = 'none';
           }
           if (l == 'quarter house') {
              living.style.display = 'none';
              threequater.style.display = 'block';
              halfway.style.display = 'none';
              treatment.style.display = 'none';
              shelter.style.display = 'none';
           }
           if (l == 'halfway house') {
              living.style.display = 'none';
              threequater.style.display = 'none';
              halfway.style.display = 'block';
              treatment.style.display = 'none';
              shelter.style.display = 'none';
           }
           if (l == 'rtp') {
              living.style.display = 'none';
              threequater.style.display = 'none';
              halfway.style.display = 'none';
              treatment.style.display = 'block';
              shelter.style.display = 'none';
           }
           if (l == 'shelter') {
              living.style.display = 'none';
              threequater.style.display = 'none';
              halfway.style.display = 'none';
              treatment.style.display = 'none';
              shelter.style.display = 'block';
           }
       }
    ";
}
