  // Portfolio filter functionality
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      // Remove active class from all buttons
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('bg-orange-500', 'text-white', 'active'));
      // Add active class to clicked button
      this.classList.add('bg-orange-500', 'text-white', 'active');
      // Get filter
      const filter = this.getAttribute('data-filter');
      // Show/hide portfolio items
      document.querySelectorAll('.portfolio-item').forEach(item => {
        if (filter === 'all' || item.getAttribute('data-category') === filter) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });