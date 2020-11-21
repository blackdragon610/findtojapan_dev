<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Support\Facades\DB;
    use PhpParser\Builder;

    class ModelClass extends Authenticatable{

        public function setTransaction(string $error, $func){
            DB::beginTransaction();
            try {
                $func();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();

                \Log::Info($e);

                echo $error;
                dd($e);
            }


        }

        public function scopeNavigation($query, $page=30)
        {
            $query
                ->offset($page * \Request::input("page"))
                ->limit($page);
        }

        /**
         *  パスワード形式に保存
         */
        public function changePassword()
        {

            if (!empty($this->password)){
                $this->password = bcrypt($this->password);
            }else{
                unset($this->password);
            }

        }

        /**
         * セッションの保存
         * @param  array  $datas
         * @return array
         */
        public function setSession(array $datas) : array
        {
            $tableName = $this->getTable();

            \Session::put("session_" . $tableName, $datas);

            return $datas;
        }

        /**
         * セッションの保存
         */
        public function getSession() : array
        {
            $tableName = $this->getTable();

            $datas = \Session::get("session_" . $tableName);

            return $datas;
        }

        /**
         * 保存しているデータをモデルに設定
         */
        public function setModel(array $datas)
        {
            $tableName = $this->getTable();

            $columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($tableName);

            foreach ($columns as $column){
                if (isset($datas[$column])){
                    if (is_array($datas[$column])){
                        //配列の場合はjsonにする
                        $this->$column = json_encode($datas[$column]);
                    }else{
                        $this->$column = $datas[$column];
                    }
                }
            }
        }

        /**
         * 保存しているデータを表示形式に設定
         */
        public function setView()
        {
            $tableName = $this->getTable();
            $columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($tableName);

            foreach ($columns as $column){
                if (!empty($this[$column])){
                    $json = json_decode($this[$column]);


                    if (json_last_error() === JSON_ERROR_NONE) {
                        //配列のjsonを配列にする
                        $this->$column = json_decode($this[$column], true);
                    }else{
                        $this->$column = $this[$column];
                        if ($column == "password"){
                            unset($this->$column);
                        }
                    }
                }
            }

        }

    }
