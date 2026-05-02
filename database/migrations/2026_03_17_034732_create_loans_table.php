    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siswa_id');
            
           
            $table->integer('book_id');

            $table->date('loan_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->string('status')->default('borrowed');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('loans');
        }
    };
