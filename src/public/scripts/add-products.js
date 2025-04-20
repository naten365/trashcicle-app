document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('productForm');
  const productName = document.getElementById('productName');
  const productPrice = document.getElementById('productPrice');
  const productDescription = document.getElementById('productDescription');
  const productImage = document.getElementById('productImage');
  const imagePreview = document.getElementById('imagePreview');
  const fileUploadContainer = document.getElementById('fileUploadContainer');
  
  // Modal elements
  const modal = document.getElementById('tipsModal');
  const closeModal = document.getElementById('closeModal');
  const modalButton = document.getElementById('modalButton');
  const openTips = document.getElementById('openTips');
  
  // Mostrar modal al cargar la página
  setTimeout(() => {
      modal.classList.add('show');
  }, 500);
  
  // Cerrar modal
  closeModal.addEventListener('click', () => {
      modal.classList.remove('show');
  });
  
  modalButton.addEventListener('click', () => {
      modal.classList.remove('show');
  });
  
  // Abrir modal con el botón flotante
  openTips.addEventListener('click', () => {
      modal.classList.add('show');
  });
  
  // Cerrar modal haciendo clic fuera del contenido
  modal.addEventListener('click', (e) => {
      if (e.target === modal) {
          modal.classList.remove('show');
      }
  });
  
  // Validación en tiempo real
  const inputs = [productName, productPrice, productDescription, productImage];
  
  inputs.forEach(input => {
      input.addEventListener('blur', function() {
          validateField(input);
      });
      
      input.addEventListener('input', function() {
          if (input.closest('.form-group').classList.contains('has-error')) {
              validateField(input);
          }
      });
  });
  
  // Efecto de arrastrar y soltar
  fileUploadContainer.addEventListener('dragover', function(e) {
      e.preventDefault();
      this.style.borderColor = 'var(--primary)';
      this.style.backgroundColor = 'rgba(76, 209, 55, 0.1)';
  });
  
  fileUploadContainer.addEventListener('dragleave', function() {
      if (!productImage.files || !productImage.files[0]) {
          this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
          this.style.backgroundColor = 'rgba(255, 255, 255, 0.05)';
      }
  });
  
  fileUploadContainer.addEventListener('drop', function(e) {
      e.preventDefault();
      if (e.dataTransfer.files && e.dataTransfer.files[0]) {
          productImage.files = e.dataTransfer.files;
          
          const event = new Event('change');
          productImage.dispatchEvent(event);
      }
  });
  
  // Validación al enviar el formulario
  form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      let isValid = true;
      
      inputs.forEach(input => {
          if (!validateField(input)) {
              isValid = false;
          }
      });
      
      if (isValid) {
          // Aquí se manejaría el envío del formulario
          alert('¡Producto agregado exitosamente!');
          form.reset();
          imagePreview.style.display = 'none';
          fileUploadContainer.style.borderColor = 'rgba(255, 255, 255, 0.2)';
          fileUploadContainer.style.backgroundColor = 'rgba(255, 255, 255, 0.05)';
      }
  });
  
  // Función para validar un campo específico
  function validateField(field) {
      const parent = field.closest('.form-group');
      
      switch(field.id) {
          case 'productName':
              if (!field.value.trim()) {
                  setError(parent, 'El nombre del producto es obligatorio');
                  return false;
              }
              break;
          case 'productPrice':
              if (!field.value || isNaN(field.value) || Number(field.value) <= 0) {
                  setError(parent, 'El precio debe ser un número mayor a 0');
                  return false;
              }
              break;
          case 'productDescription':
              if (!field.value.trim()) {
                  setError(parent, 'La descripción del producto es obligatoria');
                  return false;
              }
              break;
          case 'productImage':
              if (!field.files || !field.files[0]) {
                  setError(parent, 'Se requiere una imagen del producto');
                  return false;
              }
              
              const file = field.files[0];
              const fileType = file.type;
              const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
              
              if (!validImageTypes.includes(fileType)) {
                  setError(parent, 'Por favor, selecciona un archivo de imagen válido (JPEG, PNG, GIF, WEBP)');
                  return false;
              }
              
              if (file.size > 5 * 1024 * 1024) { // 5MB
                  setError(parent, 'El tamaño de la imagen no debe exceder los 5MB');
                  return false;
              }
              break;
      }
      
      clearError(parent);
      return true;
  }
  
  function setError(element, message) {
      element.classList.add('has-error');
      const errorMessage = element.querySelector('.error-message');
      if (errorMessage) {
          errorMessage.textContent = message;
      }
  }
  
  function clearError(element) {
      element.classList.remove('has-error');
  }
});