<template>
  <div class="sign-container">
    <div class="sign-wrapper">
      <div class="sign">
        <div class="sign-content">
          <h1 class="title">TAVERN KEEPER</h1>
          <span class="subtitle">Onde as lendas nascem</span>
        </div>
        <span class="chain left"></span>
        <span class="chain right"></span>
      </div>
    </div>
  </div>
</template>

<style scoped>

.sign-container {
  display: flex;
  justify-content: center;
  padding: 80px 0;
  background: transparent;
}

.sign-wrapper {
  position: relative;
}

.sign {
  position: relative;
  width: 550px; 
  height: 250px;
  background-color: var(--color-spice);
  background-image: 
    linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, transparent 15%, transparent 85%, rgba(0,0,0,0.3) 100%),
    linear-gradient(to right, 
      var(--color-spice) 0%, 
      var(--color-santa-fe) 15%, 
      var(--color-spice) 30%, 
      var(--color-santa-fe) 45%, 
      var(--color-spice) 60%, 
      var(--color-santa-fe) 75%, 
      var(--color-spice) 90%, 
      var(--color-santa-fe) 100%
    );
  border: 10px solid #2a1b18;
  border-radius: 4px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-sizing: border-box;
}

.sign-content {
  width: calc(100% - 24px);
  height: calc(100% - 24px);
  border: 3px solid var(--color-di-serria);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  background: rgba(0, 0, 0, 0.2);
}

.title {
  color: var(--color-rajah);
  font-family: 'Draconis', sans-serif;
  font-weight: bold;
  font-size: 3.8rem;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin: 0;
  line-height: 0.85;
  text-shadow: 4px 4px 0px var(--color-black);
}

.subtitle {
  color: var(--color-di-serria);
  /* Fonte Cinzel: Elegante, medieval, mas muito legível */
  font-family: 'Cinzel', serif; 
  font-size: 1.3rem;
  font-weight: 700;
  text-transform: uppercase; /* Fica excelente em caps na Cinzel */
  margin-top: 15px;
  letter-spacing: 0.15em;
  text-shadow: 2px 2px 2px var(--color-black);
}

/* Correntes */
.chain {
  position: absolute;
  top: -85px; 
  width: 16px;
  height: 90px;
  background-image: linear-gradient(
    to right, 
    #111 0%, 
    var(--color-di-serria) 45%, 
    var(--color-rajah) 50%, 
    var(--color-di-serria) 55%, 
    #111 100%
  );
  border-radius: 4px;
}

.chain.left { left: 65px; }
.chain.right { right: 65px; }

.chain::after {
  content: '';
  position: absolute;
  bottom: 8px;
  left: 50%;
  transform: translateX(-50%);
  width: 10px;
  height: 10px;
  background: var(--color-black);
  border: 1px solid var(--color-flamingo);
  border-radius: 50%;
}
</style>