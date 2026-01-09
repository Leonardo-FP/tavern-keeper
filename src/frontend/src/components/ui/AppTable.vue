<script setup>

</script>

<template>
    <table class="medieval-table">
        <thead>
            <slot name="head" />
        </thead>
        <tbody>
           <slot name="body" />
        </tbody>
    </table>
</template>

<style>
    .medieval-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
    }

    /* Header */
    .medieval-table thead th {
        padding: 10px 12px;
        border-bottom: 2px solid rgba(80, 50, 20, 0.5);
    }

    /* Linhas */
    .medieval-table tbody tr {
        transition: background 0.2s ease;
    }

    .medieval-table tbody tr:hover {
        background: rgba(0, 0, 0, 0.04);
    }

    /* Células */
    .medieval-table td {
        padding: 10px 12px;
        border-bottom: 1px solid rgba(80, 50, 20, 0.25);
    }

    /* Última linha sem borda pesada */
    .medieval-table tbody tr:last-child td {
        border-bottom: none;
    }

    .status {
        font-size: 0.75rem;
        font-weight: 600;
        font-size: 0.7em;
        letter-spacing: 0.04em;
        padding: 2px 6px;
        border-radius: 2px;
        background: rgba(0, 0, 0, 1);
        color: #2b1a0f;
    }

    /* Andamento */
    .status.andamento {
        background: rgba(160, 110, 40, 0.5);
        color: #5a3b16;
    }

    /* Concluída */
    .status.concluida {
        background: rgba(70, 120, 80, 0.5);
        color: #2f5a3a;
    }

    /* Cancelada */
    .status.cancelada {
        background: rgba(140, 60, 60, 0.5);
        color: #5a2b2b;
    }

    .btn-medieval {
        border: 1px solid #3b2415;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.8em;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.15s ease;
    }

    .btn-medieval:hover {
        background: var(--color-flamingo);
        color: black;
    }

    .btn-medieval:active {
        transform: translateY(1px);
    }
</style>