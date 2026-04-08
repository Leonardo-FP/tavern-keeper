<template>
    <div class="medieval-frame">
        <div class="medieval-frame-content">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>
    /* Estilização de áreas de conteúdo */
    .medieval-frame {
        padding: 14px;
        background: linear-gradient(
            135deg,
            #4a2e1f,
            #6b422a,
            #3b2418
        );
        border-radius: 10px;
        box-shadow:
            inset 0 0 0 3px #2b160d,
            inset 0 0 0 6px #8a5a3a,
            0 10px 25px rgba(0, 0, 0, 0.5);
    }

    /* Miolo */
    .medieval-frame-content {
        background-color: var(--color-santa-fe);

        padding: 20px;
        border-radius: 6px;

        box-shadow:
            inset 0 0 20px rgba(0, 0, 0, 0.08),
            inset 0 0 4px rgba(0, 0, 0, 0.12);
    }
</style>