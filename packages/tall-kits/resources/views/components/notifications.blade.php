<x-tall-notifications.primary />
<script>
    window.addEventListener("notification", (event) => {
        window.notification(event.detail)
    });
</script>
