<script>

    let hidden = true;

    function submenu() {

        $('.side-nav-sub').each(function () {

            this.style.display = hidden ? 'block' : 'none';

        });

        hidden = !hidden;

    }
</script>
<div class="side-nav">
    <div class="d-flex flex-column justify-content-center h-100">
        <a href="{{ route('user.index') }}" class="py-xxxl-3 btn btn-outline-success border-0"><i class="fas fa-users-cog fa-3x"></i><h2 class="side-nav-text">Benutzer</h2></a>
        <a href="{{ route('category.index') }}" class="py-xxxl-3 btn btn-outline-success border-0"><i class="fas fa-book fa-3x"></i><h2 class="side-nav-text">Berufe</h2></a>
        <a href="{{ route('question.index') }}" class="py-xxxl-3 btn btn-outline-success border-0"><i class="fas fa-question-circle fa-3x"></i><h2 class="side-nav-text">Fragen</h2></a>
        <a href="{{ route('sheet.index') }}" class="py-xxxl-3 btn btn-outline-success border-0"><i class="fas fa-plus-circle fa-3x"></i><h2 class="side-nav-text">Fragebögen</h2></a>

        <button onclick="submenu()" class="py-xxxl-3 btn btn-outline-danger border-0"><i class="fas fa-unlock-alt fa-3x"></i><h2 class="side-nav-text">Freigeben <i class="fas fa-sort-down"></i></h2></button>

        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action side-nav-sub" href="{{ route('assign.index') }}">
                Benutzer
            </a>
            <a class="list-group-item list-group-item-action side-nav-sub" href="{{ route('assign.cat.index') }}">
                Berufe
            </a>
        </div>

        <a href="{{ route('evaluation') }}" class="py-xxxl-3 btn btn-outline-light border-0"><i class="fas fa-pen fa-3x"></i><h2 class="side-nav-text">Lösungen</h2></a>
    </div>
</div>
