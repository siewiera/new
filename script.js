  var style_border = "border-color: #14ce31; transition: border-left-color 0.5s ease-in-out, border-top-color 1s ease-in-out, border-right-color 0.5s ease-in-out;"
  var style_border_wh = "border-color: white; transition: border-left-color 0.5s ease-in-out, border-top-color 1s ease-in-out, border-right-color 0.5s ease-in-out;"



  if (document.getElementById('ilosc1').value == '') {
      document.getElementById('ilosc1').value = 1;
  }
  if (document.getElementById('cena_podz1').value == '') {
      document.getElementById('cena_podz1').value = 0;
  }
  if (document.getElementById('cena_uslugi1').value == '') {
      document.getElementById('cena_uslugi1').value = 0;
  }
  if (document.getElementById('marza1').value == '') {
      document.getElementById('marza1').value = 20;
  }
  if (document.getElementById('rabat1').value == '') {
      document.getElementById('rabat1').value = 0;
  }



  function wylicz() {
      var nazwa = document.getElementById('nazwa1').value;
      var ilosc = document.getElementById('ilosc1').value;
      var cena_podz = document.getElementById('cena_podz1').value;
      var cena_uslugi = document.getElementById('cena_uslugi1').value;
      var marza = document.getElementById('marza1').value;
      var rabat = document.getElementById('rabat1').value;
      //   zmienna przechowuje sume ceny podz
      var suma_naleznosc = 0;
      //   zmienna przechowuje sume ceny uslugi
      var suma_uslugi = 0;

      suma_naleznosc = parseFloat(cena_podz * ilosc);
      suma_uslugi = parseFloat(cena_uslugi * ilosc);
      //wyliczenie marzy
      var wylicz_marza = 0;
      if (marza >= 1) {
          wylicz_marza = Math.round(parseFloat(suma_naleznosc * marza) / 100);
          suma_naleznosc = Math.round(parseFloat(suma_naleznosc + wylicz_marza));

          var wylicz_marza = document.getElementById('marza_zl1').value = wylicz_marza;
      } else {
          var wylicz_marza = document.getElementById('marza_zl1').value = wylicz_marza;
      }
      //wyliczenie rabatu
      var wylicz_rabat = 0;
      if (rabat >= 1) {
          wylicz_rabat = Math.round(-parseFloat(suma_uslugi * rabat) / 100);
          suma_uslugi = Math.round(parseFloat(suma_uslugi + wylicz_rabat));
          var wylicz_rabat = document.getElementById('rabat_zl1').value = wylicz_rabat;
      } else {
          var wylicz_rabat = document.getElementById('rabat_zl1').value = wylicz_rabat;
      }

      document.getElementById('naleznosc1').value = suma_naleznosc + parseFloat(suma_uslugi);
      var naleznosc = document.getElementById('naleznosc1').value;

      document.getElementById('zysk1').value = parseFloat(naleznosc - (cena_podz * ilosc));

      if (nazwa.length >= 1) {
          document.getElementById('nr_pods1').innerHTML = '1. ' + nazwa + ' x ' + ilosc + ' szt'
          document.getElementById('naleznosc_pods1').innerHTML = 'Cena: ' + naleznosc + ' zł';

      } else {
          document.getElementById('nr_pods1').innerHTML = '1. Brak pozycji';
          document.getElementById('naleznosc_pods1').innerHTML = 'Cena: ' + naleznosc + ' zł';

      }

      if (document.getElementById('nazwa2') !== null) {

          if (document.getElementById('ilosc2').value == '') {
              document.getElementById('ilosc2').value = 1;
          }
          if (document.getElementById('cena_podz2').value == '') {
              document.getElementById('cena_podz2').value = 0;
          }
          if (document.getElementById('cena_uslugi2').value == '') {
              document.getElementById('cena_uslugi2').value = 0;
          }
          if (document.getElementById('marza2').value == '') {
              document.getElementById('marza2').value = 20;
          }
          if (document.getElementById('rabat2').value == '') {
              document.getElementById('rabat2').value = 0;
          }
          ///2 pozycja
          var nazwa2 = document.getElementById('nazwa2').value;
          var ilosc2 = document.getElementById('ilosc2').value;
          var cena_podz2 = document.getElementById('cena_podz2').value;
          var cena_uslugi2 = document.getElementById('cena_uslugi2').value;
          var marza2 = document.getElementById('marza2').value;
          var rabat2 = document.getElementById('rabat2').value;
          var suma_naleznosc2 = 0;
          //   zmienna przechowuje sume ceny uslugi
          var suma_uslugi2 = 0;

          // zabarwienie ramki po wprowadzeniu poprawnej ilości znaków w okienka
          if (nazwa2.length >= 3 && ilosc2.length >= 1 && cena_podz2.length >= 1 && cena_uslugi2.length >= 1) {
              document.getElementById("wycena_pojemnik2").style.cssText = style_border +
                  "box-shadow: 0px 0px 10px 0px #14ce31; transition: 1s ease-in-out";

          } else {
              document.getElementById("wycena_pojemnik2").style.cssText = style_border_wh +
                  "box-shadow: 0px 0px 10px 0px white; transition: 1s ease-in-out";
          }


          suma_naleznosc2 = parseFloat(cena_podz2 * ilosc2);
          suma_uslugi2 = parseFloat(cena_uslugi2 * ilosc2);
          //wyliczenie marzy
          var wylicz_marza2 = 0;
          if (marza2 >= 1) {
              wylicz_marza2 = Math.round(parseFloat(suma_naleznosc2 * marza2) / 100);
              suma_naleznosc2 = Math.round(parseFloat(suma_naleznosc2 + wylicz_marza2));

              var wylicz_marza2 = document.getElementById('marza_zl2').value = wylicz_marza2;
          } else {
              var wylicz_marza2 = document.getElementById('marza_zl2').value = wylicz_marza2;
          }
          //wyliczenie rabatu
          var wylicz_rabat2 = 0;
          if (rabat2 >= 1) {
              wylicz_rabat2 = Math.round(-parseFloat(suma_uslugi2 * rabat2) / 100);
              suma_uslugi2 = Math.round(parseFloat(suma_uslugi2 + wylicz_rabat2));
              var wylicz_rabat2 = document.getElementById('rabat_zl2').value = wylicz_rabat2;
          } else {
              var wylicz_rabat2 = document.getElementById('rabat_zl2').value = wylicz_rabat2;
          }

          document.getElementById('naleznosc2').value = suma_naleznosc2 + parseFloat(suma_uslugi2);
          var naleznosc2 = document.getElementById('naleznosc2').value;

          document.getElementById('zysk2').value = parseFloat(naleznosc2 - (cena_podz2 * ilosc2));

          if (nazwa2.length >= 1) {
              document.getElementById('nr_pods2').innerHTML = '2. ' + nazwa2 + ' x ' + ilosc2 + ' szt'
              document.getElementById('naleznosc_pods2').innerHTML = 'Cena: ' + naleznosc2 + ' zł';

          } else {
              document.getElementById('nr_pods2').innerHTML = '2. Brak pozycji';
              document.getElementById('naleznosc_pods2').innerHTML = 'Cena: ' + naleznosc2 + ' zł';

          }
      }
      if (document.getElementById('nazwa3') !== null) {

          if (document.getElementById('ilosc3').value == '') {
              document.getElementById('ilosc3').value = 1;
          }
          if (document.getElementById('cena_podz3').value == '') {
              document.getElementById('cena_podz3').value = 0;
          }
          if (document.getElementById('cena_uslugi3').value == '') {
              document.getElementById('cena_uslugi3').value = 0;
          }
          if (document.getElementById('marza3').value == '') {
              document.getElementById('marza3').value = 20;
          }
          if (document.getElementById('rabat3').value == '') {
              document.getElementById('rabat3').value = 0;
          }

          ///3 pozycja
          var nazwa3 = document.getElementById('nazwa3').value;
          var ilosc3 = document.getElementById('ilosc3').value;
          var cena_podz3 = document.getElementById('cena_podz3').value;
          var cena_uslugi3 = document.getElementById('cena_uslugi3').value;
          var marza3 = document.getElementById('marza3').value;
          var rabat3 = document.getElementById('rabat3').value;
          var suma_naleznosc3 = 0;
          //   zmienna przechowuje sume ceny uslugi
          var suma_uslugi3 = 0;

          // zabarwienie ramki po wprowadzeniu poprawnej ilości znaków w okienka
          if (nazwa3.length >= 3 && ilosc3.length >= 1 && cena_podz3.length >= 1 && cena_uslugi3.length >= 1) {
              document.getElementById("wycena_pojemnik3").style.cssText = style_border +
                  "box-shadow: 0px 0px 10px 0px #14ce31; transition: 1s ease-in-out";

          } else {
              document.getElementById("wycena_pojemnik3").style.cssText = style_border_wh +
                  "box-shadow: 0px 0px 10px 0px white; transition: 1s ease-in-out";
          }

          suma_naleznosc3 = parseFloat(cena_podz3 * ilosc3);
          suma_uslugi3 = parseFloat(cena_uslugi3 * ilosc3);
          //wyliczenie marzy
          var wylicz_marza3 = 0;
          if (marza3 >= 1) {
              wylicz_marza3 = Math.round(parseFloat(suma_naleznosc3 * marza3) / 100);
              suma_naleznosc3 = Math.round(parseFloat(suma_naleznosc3 + wylicz_marza3));

              var wylicz_marza3 = document.getElementById('marza_zl3').value = wylicz_marza3;
          } else {
              var wylicz_marza3 = document.getElementById('marza_zl3').value = wylicz_marza3;
          }
          //wyliczenie rabatu
          var wylicz_rabat3 = 0;
          if (rabat3 >= 1) {
              wylicz_rabat3 = Math.round(-parseFloat(suma_uslugi3 * rabat3) / 100);
              suma_uslugi3 = Math.round(parseFloat(suma_uslugi3 + wylicz_rabat3));
              var wylicz_rabat3 = document.getElementById('rabat_zl3').value = wylicz_rabat3;
          } else {
              var wylicz_rabat3 = document.getElementById('rabat_zl3').value = wylicz_rabat3;
          }

          document.getElementById('naleznosc3').value = suma_naleznosc3 + parseFloat(suma_uslugi3);
          var naleznosc3 = document.getElementById('naleznosc3').value;

          document.getElementById('zysk3').value = parseFloat(naleznosc3 - (cena_podz3 * ilosc3));

          if (nazwa3.length >= 1) {
              document.getElementById('nr_pods3').innerHTML = '3. ' + nazwa3 + ' x ' + ilosc3 + ' szt'
              document.getElementById('naleznosc_pods3').innerHTML = 'Cena: ' + naleznosc3 + ' zł';

          } else {
              document.getElementById('nr_pods3').innerHTML = '3. Brak pozycji';
              document.getElementById('naleznosc_pods3').innerHTML = 'Cena: ' + naleznosc3 + ' zł';

          }
      }
      if (document.getElementById('nazwa4') !== null) {

          if (document.getElementById('ilosc4').value == '') {
              document.getElementById('ilosc4').value = 1;
          }
          if (document.getElementById('cena_podz4').value == '') {
              document.getElementById('cena_podz4').value = 0;
          }
          if (document.getElementById('cena_uslugi4').value == '') {
              document.getElementById('cena_uslugi4').value = 0;
          }
          if (document.getElementById('marza4').value == '') {
              document.getElementById('marza4').value = 20;
          }
          if (document.getElementById('rabat4').value == '') {
              document.getElementById('rabat4').value = 0;
          }

          ///4 pozycja
          var nazwa4 = document.getElementById('nazwa4').value;
          var ilosc4 = document.getElementById('ilosc4').value;
          var cena_podz4 = document.getElementById('cena_podz4').value;
          var cena_uslugi4 = document.getElementById('cena_uslugi4').value;
          var marza4 = document.getElementById('marza4').value;
          var rabat4 = document.getElementById('rabat4').value;
          var suma_naleznosc4 = 0;
          //   zmienna przechowuje sume ceny uslugi
          var suma_uslugi4 = 0;

          // zabarwienie ramki po wprowadzeniu poprawnej ilości znaków w okienka
          if (nazwa4.length >= 3 && ilosc4.length >= 1 && cena_podz4.length >= 1 && cena_uslugi4.length >= 1) {
              document.getElementById("wycena_pojemnik4").style.cssText = style_border +
                  "box-shadow: 0px 0px 10px 0px #14ce31; transition: 1s ease-in-out";

          } else {
              document.getElementById("wycena_pojemnik4").style.cssText = style_border_wh +
                  "box-shadow: 0px 0px 10px 0px white; transition: 1s ease-in-out";
          }

          suma_naleznosc4 = parseFloat(cena_podz4 * ilosc4);
          suma_uslugi4 = parseFloat(cena_uslugi4 * ilosc4);
          //wyliczenie marzy
          var wylicz_marza4 = 0;
          if (marza4 >= 1) {
              wylicz_marza4 = Math.round(parseFloat(suma_naleznosc4 * marza4) / 100);
              suma_naleznosc4 = Math.round(parseFloat(suma_naleznosc4 + wylicz_marza4));

              var wylicz_marza4 = document.getElementById('marza_zl4').value = wylicz_marza4;
          } else {
              var wylicz_marza4 = document.getElementById('marza_zl4').value = wylicz_marza4;
          }
          //wyliczenie rabatu
          var wylicz_rabat4 = 0;
          if (rabat4 >= 1) {
              wylicz_rabat4 = Math.round(-parseFloat(suma_uslugi4 * rabat4) / 100);
              suma_uslugi4 = Math.round(parseFloat(suma_uslugi4 + wylicz_rabat4));
              var wylicz_rabat4 = document.getElementById('rabat_zl4').value = wylicz_rabat4;
          } else {
              var wylicz_rabat4 = document.getElementById('rabat_zl4').value = wylicz_rabat4;
          }

          document.getElementById('naleznosc4').value = suma_naleznosc4 + parseFloat(suma_uslugi4);
          var naleznosc4 = document.getElementById('naleznosc4').value;

          document.getElementById('zysk4').value = parseFloat(naleznosc4 - (cena_podz4 * ilosc4));

          if (nazwa4.length >= 1) {
              document.getElementById('nr_pods4').innerHTML = '4. ' + nazwa4 + ' x ' + ilosc4 + ' szt'
              document.getElementById('naleznosc_pods4').innerHTML = 'Cena: ' + naleznosc4 + ' zł';

          } else {
              document.getElementById('nr_pods4').innerHTML = '4. Brak pozycji';
              document.getElementById('naleznosc_pods4').innerHTML = 'Cena: ' + naleznosc4 + ' zł';

          }
      }
      if (document.getElementById('nazwa5') !== null) {

          if (document.getElementById('ilosc5').value == '') {
              document.getElementById('ilosc5').value = 1;
          }
          if (document.getElementById('cena_podz5').value == '') {
              document.getElementById('cena_podz5').value = 0;
          }
          if (document.getElementById('cena_uslugi5').value == '') {
              document.getElementById('cena_uslugi5').value = 0;
          }
          if (document.getElementById('marza5').value == '') {
              document.getElementById('marza5').value = 20;
          }
          if (document.getElementById('rabat5').value == '') {
              document.getElementById('rabat5').value = 0;
          }

          ///5 pozycja
          var nazwa5 = document.getElementById('nazwa5').value;
          var ilosc5 = document.getElementById('ilosc5').value;
          var cena_podz5 = document.getElementById('cena_podz5').value;
          var cena_uslugi5 = document.getElementById('cena_uslugi5').value;
          var marza5 = document.getElementById('marza5').value;
          var rabat5 = document.getElementById('rabat5').value;
          var suma_naleznosc5 = 0;
          //   zmienna przechowuje sume ceny uslugi
          var suma_uslugi5 = 0;

          // zabarwienie ramki po wprowadzeniu poprawnej ilości znaków w okienka
          if (nazwa5.length >= 3 && ilosc5.length >= 1 && cena_podz5.length >= 1 && cena_uslugi5.length >= 1) {
              document.getElementById("wycena_pojemnik5").style.cssText = style_border +
                  "box-shadow: 0px 0px 10px 0px #14ce31; transition: 1s ease-in-out";

          } else {
              document.getElementById("wycena_pojemnik5").style.cssText = style_border_wh +
                  "box-shadow: 0px 0px 10px 0px white; transition: 1s ease-in-out";
          }

          suma_naleznosc5 = parseFloat(cena_podz5 * ilosc5);
          suma_uslugi5 = parseFloat(cena_uslugi5 * ilosc5);
          //wyliczenie marzy
          var wylicz_marza5 = 0;
          if (marza5 >= 1) {
              wylicz_marza5 = Math.round(parseFloat(suma_naleznosc5 * marza5) / 100);
              suma_naleznosc5 = Math.round(parseFloat(suma_naleznosc5 + wylicz_marza5));

              var wylicz_marza5 = document.getElementById('marza_zl5').value = wylicz_marza5;
          } else {
              var wylicz_marza5 = document.getElementById('marza_zl5').value = wylicz_marza5;
          }
          //wyliczenie rabatu
          var wylicz_rabat5 = 0;
          if (rabat5 >= 1) {
              wylicz_rabat5 = Math.round(-parseFloat(suma_uslugi5 * rabat5) / 100);
              suma_uslugi5 = Math.round(parseFloat(suma_uslugi5 + wylicz_rabat5));
              var wylicz_rabat5 = document.getElementById('rabat_zl5').value = wylicz_rabat5;
          } else {
              var wylicz_rabat5 = document.getElementById('rabat_zl5').value = wylicz_rabat5;
          }

          document.getElementById('naleznosc5').value = suma_naleznosc5 + parseFloat(suma_uslugi5);
          var naleznosc5 = document.getElementById('naleznosc5').value;

          document.getElementById('zysk5').value = parseFloat(naleznosc5 - (cena_podz5 * ilosc5));

          if (nazwa5.length >= 1) {
              document.getElementById('nr_pods5').innerHTML = '5. ' + nazwa5 + ' x ' + ilosc5 + ' szt'
              document.getElementById('naleznosc_pods5').innerHTML = 'Cena: ' + naleznosc5 + ' zł';

          } else {
              document.getElementById('nr_pods5').innerHTML = '5. Brak pozycji';
              document.getElementById('naleznosc_pods5').innerHTML = 'Cena: ' + naleznosc5 + ' zł';

          }
      }
  }

  setInterval(function() {
      wylicz();
  }, 100);
  window.onload = wylicz;

  function baza_klient() {

      var b_i = document.getElementById('b_i').value;

      // pobieranie klienta z bazy
      for (x = 1; x <= b_i; x++) {
          if (document.getElementById('b_ch' + x).checked) {

              var imie1 = document.getElementById('b_imie' + x).value;
              var nazwisko1 = document.getElementById('b_nazwisko' + x).value;
              var adres1 = document.getElementById('b_adres' + x).value;
              var nr_tel1 = document.getElementById('b_nr_tel' + x).value;
              var id1 = document.getElementById('b_id' + x).value;
              var vip1 = document.getElementById('b_vip' + x).value;

              document.getElementById('imie').value = imie1;
              document.getElementById('nazwisko').value = nazwisko1;
              document.getElementById('adres').value = adres1;
              document.getElementById('nr_tel').value = nr_tel1;
              document.getElementById('klientID').value = id1;
              document.getElementById('vip').value = vip1;

              document.getElementById('b_ch' + x).checked = false;

          }
      }
  }

  function czysc_dane_klienta() {
      document.getElementById('imie').value = "";
      document.getElementById('nazwisko').value = "";
      document.getElementById('adres').value = "";
      document.getElementById('nr_tel').value = "";
      document.getElementById('klientID').value = "";
      document.getElementById('vip').value = "";
  }

  function czysc_dane_sprzetowe() {
      document.getElementById('sprzet').value = "";
      document.getElementById('marka').value = "";
      document.getElementById('model').value = "";
      document.getElementById('zestaw').value = "";
      document.getElementById('opis').value = "";
  }

  function czysc_pozycje_platnosciowe1() {
      if (document.getElementById('nazwa1') !== null) {
          document.getElementById('nazwa1').value = "";
          document.getElementById('ilosc1').value = 1;
          document.getElementById('cena_podz1').value = 0;
          document.getElementById('cena_uslugi1').value = 0;
          document.getElementById('marza1').value = 20;
          document.getElementById('rabat1').value = 0;
          document.getElementById('status1').value = "Do akceptacji";
      }
  }

  function czysc_pozycje_platnosciowe2() {
      if (document.getElementById('nazwa2') !== null) {
          document.getElementById('nazwa2').value = "";
          document.getElementById('ilosc2').value = 1;
          document.getElementById('cena_podz2').value = 0;
          document.getElementById('cena_uslugi2').value = 0;
          document.getElementById('marza2').value = 20;
          document.getElementById('rabat2').value = 0;
          document.getElementById('status2').value = "Do akceptacji";
      }
  }

  function czysc_pozycje_platnosciowe3() {
      if (document.getElementById('nazwa3') !== null) {
          document.getElementById('nazwa3').value = "";
          document.getElementById('ilosc3').value = 1;
          document.getElementById('cena_podz3').value = 0;
          document.getElementById('cena_uslugi3').value = 0;
          document.getElementById('marza3').value = 20;
          document.getElementById('rabat3').value = 0;
          document.getElementById('status3').value = "Do akceptacji";
      }
  }

  function czysc_pozycje_platnosciowe4() {
      if (document.getElementById('nazwa4') !== null) {
          document.getElementById('nazwa4').value = "";
          document.getElementById('ilosc4').value = 1;
          document.getElementById('cena_podz4').value = 0;
          document.getElementById('cena_uslugi4').value = 0;
          document.getElementById('marza4').value = 20;
          document.getElementById('rabat4').value = 0;
          document.getElementById('status4').value = "Do akceptacji";
      }
  }

  function czysc_pozycje_platnosciowe5() {
      if (document.getElementById('nazwa5') !== null) {
          document.getElementById('nazwa5').value = "";
          document.getElementById('ilosc5').value = 1;
          document.getElementById('cena_podz5').value = 0;
          document.getElementById('cena_uslugi5').value = 0;
          document.getElementById('marza5').value = 20;
          document.getElementById('rabat5').value = 0;
          document.getElementById('status5').value = "Do akceptacji";
      }

  }

  function czysc_dane_platnosciowe() {
      czysc_pozycje_platnosciowe1();
      czysc_pozycje_platnosciowe2();
      czysc_pozycje_platnosciowe3();
      czysc_pozycje_platnosciowe4();
      czysc_pozycje_platnosciowe5();
  }