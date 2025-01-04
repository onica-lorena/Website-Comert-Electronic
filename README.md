# Magazin Online - Platformă de Comerț Electronic

Acest proiect reprezintă o aplicație web pentru un magazin online, care oferă utilizatorilor funcționalități precum gestionarea produselor, un coș de cumpărături dinamic și posibilitatea de autentificare și înregistrare.

## Funcționalități
1. **Gestionarea Produselor**
   - Vizualizare produse.
   - Filtrare produse pe categorii.
   - Căutare după numele produsului.

2. **Coș de Cumpărături**
   - Adăugarea produselor în coș.
   - Actualizarea cantităților produselor.
   - Ștergerea produselor din coș.
   - Calcularea sumei totale a produselor din coș.

3. **Autentificare și Înregistrare**
   - Crearea unui cont nou.
   - Conectarea utilizatorilor existenți.
   - Gestionarea sesiunilor utilizatorilor.

4. **Contact și Promotii**
   - Pagini dedicate pentru contact și promoții.
   - Oferte aplicate automat la produsele selectate.

---

## Structura Proiectului

- **Frontend**:
  - **HTML/CSS/JS**: Implementarea interfeței utilizator.
  - **JQuery**: Funcționalități dinamice.

- **Backend**:
  - **PHP**: Logica aplicației, manipularea datelor și gestionarea sesiunilor.
  - **MySQL**: Stocarea datelor despre utilizatori, produse și tranzacții.

- **Fișiere Relevante**:
  - `index.html`: Pagina principală a magazinului.
  - `produse.php`: Listarea produselor.
  - `cos.php`: Coșul de cumpărături.
  - `login.php`/`signup.php`: Autentificare și înregistrare.
  - `adauga_in_cos.php`: Funcționalitate pentru adăugarea produselor în coș.

---

## Tehnologii Utilizate
- **Frontend**: HTML, CSS, JavaScript (jQuery).
- **Backend**: PHP.
- **Bază de date**: MySQL.

---

# Cum să rulezi aplicația

## 1. Cerințe preliminare
Pentru a rula această aplicație, ai nevoie de:
- **XAMPP** (sau un alt server web cu suport pentru PHP și MySQL).
- **Browser web** (ex.: Chrome, Firefox).
- **Git** (pentru clonarea proiectului din GitHub).

---

## 2. Clonarea proiectului
1. Deschide terminalul sau Git Bash.
2. Rulează următoarea comandă pentru a clona proiectul:
   ```bash
   git clone https://github.com/username/proiect.git
## 3. Configurarea serverului local
1. Copiază toate fișierele proiectului în directorul htdocs al XAMPP:
   ```plaintext
   C:\xampp\htdocs\proiect
2. Pornește serverul Apache și MySQL din XAMPP Control Panel.

## 4. Configurarea bazei de date
1. Accesează phpMyAdmin:
   ```plaintext
   http://localhost/phpmyadmin
2. Creează o bază de date nouă cu numele:
   ```plaintext
   proiect_db
3. Importă fișierul bazei de date:
   - Navighează la tab-ul Import din phpMyAdmin.
   - Selectează fișierul SQL din proiect (de exemplu, database/database.sql).
   - Apasă pe Go pentru a importa structura și datele bazei de date.

## 5. Configurarea conexiunii la baza de date
1. Deschide fișierul connection.php din folderul proiectului.
2. Verifică și, dacă este necesar, actualizează detaliile conexiunii:
   ```php
   $con = mysqli_connect("localhost", "root", "", "proiect_db");
    
   if (!$con) {
      die("Conexiunea a eșuat: " . mysqli_connect_error());
   }
  - `localhost`: Serverul MySQL.
  - `root`: Utilizatorul MySQL (implicit în XAMPP).
  - `""`: Parola MySQL (implicit goală în XAMPP).
  - `proiect_db`: Numele bazei de date.

## 6. Accesarea aplicației
1. Deschide browserul web.
2. Accesează aplicația:
   ```plaintext
   http://localhost/proiect
3. Navighează prin aplicație și testează funcționalitățile.

## 7. Exemple de Utilizare

#### **1. Autentificare/Înregistrare**
- Accesează pagina principală a aplicației.
- Creează un cont nou sau autentifică-te folosind un cont existent.

#### **2. Adăugare Produs în Coș**
- Navighează la secțiunea **„Produse”**.
- Adaugă produsele dorite în coș utilizând butonul **„Adaugă în coș”** afișat lângă fiecare produs.

#### **3. Vizualizare Coș**
- Accesează secțiunea **„Coș”** pentru a vizualiza produsele adăugate.
- Poți:
  - **Actualiza cantitatea** fiecărui produs.
  - **Șterge produse** din coș.

#### **4. Promoții**
- Navighează la pagina **„Promoții”** pentru a vizualiza detalii despre ofertele curente, inclusiv coduri promoționale și reduceri aplicabile.

## Documentație
Documentația completă a proiectului poate fi descărcată [aici](./docs/Documentatie_Magazin_Online.pdf).



