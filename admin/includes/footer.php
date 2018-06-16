    <footer class="ui center aligned container big-padding">
        <p>Copyright &copy; <a href="http://lenuson.com">Mladen Ilic </a><?=date('Y')?></p>
    </footer>

    <!-- Main JS Script-->
    <script type="text/javascript" src="<?=ADMIN?>js/script.js"></script>
    
    <!-- WYSIWYG -->
    <script type="text/javascript" src="<?=ROOT?>js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({selector: ".edit-description,#edit-photo-area,#uploads-textarea"});
    </script>

    </div><!-- / pusher -->

</body>

</html>
