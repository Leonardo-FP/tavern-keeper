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
        color: white;
    }
</style>