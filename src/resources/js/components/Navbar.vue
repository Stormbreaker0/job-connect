<template>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="/">Job Connect</a>
    
    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
    
    <!-- Motivational Quote -->
    <div class="ms-auto me-3 text-light fst-italic quote-container">
      "{{ quote }}"
    </div>
    
    <!-- Navbar with SignOutButton -->
    <SignOutButton />
  </nav>
</template>

<script>
import SignOutButton from './SignOutButton.vue';

export default {
  components: {
    SignOutButton
  },
  data() {
    return {
      quotes: [
        "Success usually comes to those who are too busy to be looking for it.",
        "The secret of getting ahead is getting started.",
        "Do what you can, with what you have, where you are.",
        "It does not matter how slowly you go as long as you do not stop.",
        "Act as if what you do makes a difference. It does.",
        "Work hard in silence, let success make the noise.",
        "Believe you can and you’re halfway there.",
        "Success is not just about making money. It's about making a difference.",
        "Your limitation—it’s only your imagination.",
        "Dreams don’t work unless you do."
      ],
      quote: ""
    };
  },
  methods: {
    getRandomQuote() {
      const index = Math.floor(Math.random() * this.quotes.length);
      return this.quotes[index];
    }
  },
  created() {
    this.quote = this.getRandomQuote();
  }
};
</script>

<style>
/* Navbar Styles */
.sb-topnav {
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
  font-weight: bold;
  font-size: 1.5rem;
  letter-spacing: 2px;
}

/* Sidebar Toggle Button */
#sidebarToggle i {
  font-size: 1.5rem;
}

/* Motivational Quote Styling */
.quote-container {
  font-size: 1.1rem;
  max-width: 400px;
  padding: 8px 12px;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 10px;
  transition: all 0.3s ease-in-out;
  opacity: 0.9;
}

.quote-container:hover {
  background-color: rgba(255, 255, 255, 0.4);
  transform: translateY(-5px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* SignOut Button */
button {
  font-size: 1rem;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #0056b3;
}
</style>
