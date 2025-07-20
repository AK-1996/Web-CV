# Professional CV Website

A fully responsive, multi-page personal CV website built from scratch for Università di Pavia’s Web & Multimedia Technologies project.  
It showcases my background, skills, work experience and provides contact & appointment booking forms powered by PHP/MySQL.

---

## 📂 Repository Structure
```plaintext
/
├── index.html            # Homepage
├── education.html        # Education background
├── work.html             # Work experience
├── skill.html            # Technical & language skills
├── contact.html          # Contact & appointment forms
├── style/
│   ├── styleAppointment.css
│   ├── styleBookingAction.css
│   ├── styleFormAction.css
│   ├── styleHome.css
│   ├── styleEducation.css
│   ├── styleWork.css
│   ├── styleSkill.css
│   └── styleContact.css
├── js/
│   ├── scriptHome.js
│   ├── scriptEducation.js
│   ├── scriptWork.js
│   ├── scriptSkill.js
│   ├── scriptFormAction.js
│   ├── scriptBookingAction.js
│   └── scriptContact.js
├── php/
│   ├── form_action_page.php
│   ├── booking_action_page.php
│   └── Appointment_table.php
└── img/                  # All site images
```


---

## 🚀 Features

- **Responsive design**: mobile-first layout with flexible grid (`flex` + media queries).  
- **Dark/Light mode**: toggle button swaps background/text colors.  
- **Dynamic navigation**: hamburger menu on small screens, horizontal links on desktop.  
- **Contact & Booking forms**:  
  - Client-side validation (JavaScript)  
  - Server-side validation & email sending (PHP `mail()`)  
  - Appointment storage & retrieval (PHP + MySQL)  
- **Pure vanilla tech**: no Bootstrap or templates—hand-crafted HTML/CSS/JS.

---

## ⚙️ Installation & Setup

1. **Clone the repo**  
   ```bash
   git clone https://github.com/<your-username>/professional-cv-website.git
   cd professional-cv-website
   ```

2. Set up PHP & MySQL
- Use XAMPP or similar.
- Create a MySQL database for appointments.
- Update DB credentials in `php/booking_action_page.php` and `Appointment_table.php`.

3. Deploy
- Copy all files into your web-root (e.g. `htdocs/` for XAMPP).
- Access via `http://localhost/professional-cv-website/`.

---

## 🔧 Tech Stack
- Frontend: HTML5, CSS3 (Flexbox, Media Queries), JavaScript
- Backend: PHP for form processing & email, MySQL for appointment storage
- Tools: XAMPP, VS Code
