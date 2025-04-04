@extends('layouts.main_layout')
<!--Este archivo es para ver si les gusta o no? en base a eso ya los estilos los paso al respectivo archivo styles.css -->
@section('title', 'Contacto')

@section('content')
<style>
  .contact-wrapper {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 30px rgba(0,0,0,0.1);
  }

  .contact-info {
    background: linear-gradient(135deg, #0062cc, #0096ff);
    padding: 40px;
    color: white;
  }

  .contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    transition: all 0.3s ease;
  }

  .contact-item:hover {
    transform: translateX(10px);
  }

  .contact-icon {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
  }

  .social-links {
    margin-top: 30px;
  }

  .social-icon {
    width: 35px;
    height: 35px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    transition: all 0.3s ease;
  }

  .social-icon:hover {
    background: white;
    color: #0062cc;
    transform: translateY(-3px);
  }

  .contact-form {
    padding: 40px;
  }

  .form-control {
    border-radius: 10px;
    padding: 12px 15px;
    border: 2px solid #eee;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    border-color: #0062cc;
    box-shadow: none;
  }

  .form-label {
    font-weight: 500;
    margin-bottom: 8px;
  }

  .btn-submit {
    background: linear-gradient(135deg, #0062cc, #0096ff);
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    transition: all 0.3s ease;
  }

  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,98,204,0.3);
  }

  .contact-map {
    width: 100%;
    height: 250px;
    border: 0;
    border-radius: 10px;
  }
</style>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="contact-wrapper">
        <div class="row g-0">
          <!-- Columna Izquierda: Info de Contacto -->
          <div class="col-md-5">
            <div class="contact-info h-100">
              <h3 class="mb-4">Contáctanos</h3>
              <p class="mb-4">Queremos saber de ti. Completa el formulario o comunícate a través de la información de abajo.</p>

              <div class="contact-item">
                <div class="contact-icon">
                  <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                  <h6 class="mb-0">Dirección</h6>
                  <p class="mb-0">123 Business Avenue, Suite 100<br>New York, NY 10001</p>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-icon">
                  <i class="fas fa-phone"></i>
                </div>
                <div>
                  <h6 class="mb-0">Teléfono</h6>
                  <p class="mb-0">+1 (555) 123-4567</p>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-icon">
                  <i class="fas fa-envelope"></i>
                </div>
                <div>
                  <h6 class="mb-0">Email</h6>
                  <p class="mb-0">contact@company.com</p>
                </div>
              </div>

              <div class="social-links">
                <h6 class="mb-3">Síguenos</h6>
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
              </div>
            </div>
          </div>

          <!-- Columna Derecha: Formulario y Mapa -->
          <div class="col-md-7">
            <div class="contact-form">
              <h3 class="mb-4">Envíanos un mensaje</h3>
              <!-- Ajusta action y method si quieres procesar el formulario -->
              <form action="#" method="POST">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" placeholder="John">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" class="form-control" placeholder="Doe">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" placeholder="john@example.com">
                </div>

                <div class="mb-3">
                  <label class="form-label">Asunto</label>
                  <input type="text" class="form-control" placeholder="¿En qué podemos ayudarte?">
                </div>

                <div class="mb-4">
                  <label class="form-label">Mensaje</label>
                  <textarea class="form-control" rows="5" placeholder="Tu mensaje aquí..."></textarea>
                </div>

                <button type="submit" class="btn btn-submit text-white">Enviar Mensaje</button>
              </form>

              <div class="mt-5">
                <h5 class="mb-3">Nuestra ubicación</h5>
                <div class="ratio ratio-16x9">
                  <iframe 
                    class="contact-map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.6088242523726!2d-73.9854284845936!3d40.74881797932754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259ab2d2b70b1%3A0xd4c56d08aa15b0c5!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1634104251592!5m2!1sen!2sus" 
                    allowfullscreen="" 
                    loading="lazy">
                  </iframe>
                </div>
              </div><!-- Fin Mapa -->
            </div>
          </div>
        </div><!-- Fin row -->
      </div><!-- Fin contact-wrapper -->
    </div>
  </div>
</div>
@endsection
