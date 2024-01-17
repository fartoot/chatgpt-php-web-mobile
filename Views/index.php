<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function selectedChagpt(){
            type = document.getElementById("chatgpt").value;
            document.getElementById("selectedChagpt").value = type;
        }
    </script>



</head>

<body>
    <div class="flex h-screen">
        <div class="flex-auto bg-slate-300 p-4">
            <div class="">
                <div class="mb-8 mx-auto">
                    <a class="shadow-md mx-auto block w-2/5 text-center py-3 text-sm font-medium text-white bg-slate-600 border border-slate-600 rounded-full active:text-slate-500 hover:bg-transparent hover:text-slate-600 focus:outline-none focus:ring" href="/new">New Chat</a>
                </div>
                <div class="text-center ">
                    <a href="#1" class="mx-auto text-left block w-3/5 hover:ring-2 focus:ring-2 hover: ring-slate-400 rounded-lg my-2 py-4 px-4 hover:bg-white focus:bg-white"> 
                        <div class="flex justify-around">
                            <span class="text-slate-800">22/01/2024</span>
                            <svg class="fill-slate-600 sm:max-md:hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"/></svg>
                        </div>    
                    </a>
                    <a href="#1" class="mx-auto text-left block w-3/5 hover:ring-2 focus:ring-2 hover: ring-slate-400 rounded-lg my-2 py-4 px-4 hover:bg-white focus:bg-white"> 
                        <div class="flex justify-around">
                            <span class="text-slate-800">22/01/2024</span>
                            <svg class="fill-slate-600 sm:max-md:hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"/></svg>
                        </div>    
                    </a>
                    <a href="#1" class="mx-auto text-left block w-3/5 hover:ring-2 focus:ring-2 hover: ring-slate-400 rounded-lg my-2 py-4 px-4 hover:bg-white focus:bg-white"> 
                        <div class="flex justify-around">
                            <span class="text-slate-800">22/01/2024</span>
                            <svg class="fill-slate-600 sm:max-md:hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"/></svg>
                        </div>    
                    </a>

                </div>
            </div>
        </div>
        <div class="flex-auto w-8/12 bg-slate-50 py-5 px-5 lg:px-12 flex justify-center">
            <div class="lg:w-3/5 flex flex-wrap">
                <div class="flex items-center justify-center">
                        <div>
                            <select id="chatgpt"  onchange="selectedChagpt()" class="space-x-40 bg-inherit rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-slate-400">
                                <option value="0" >ChatGPT 4</option>
                                <option value="1" >ChatGPT 3.5</option>
                            </select>
                        </div>
                </div>

                <div class="h-5/6 w-full overflow-y-auto ">
                    <?php
                    foreach ($data["answers"] as $answer) {
                        echo "<div class='block bg-white p-3 mb-2 border-2 border-slate-300 rounded-md' >";
                        echo "<p class='mb-2 text-base font-bold'>" . $answer["question"] . "</p>";
                        echo $Parsedown->text($answer["answer"]);
                        echo "</div>";
                    }

                    ?>
                </div>

                <div class="w-full">
                    <form action="create" method="post">
                        <input type="hidden" name="chagpt" id="selectedChagpt" value="<?= $chatgpt ?>" >
                        <input type="text" class="shadow-lg border-2 border-slate-300 hover:border-slate-400 active:border-slate-400 rounded-full h-16 w-full px-8" name="prompt" placeholder="Your prompt ...">
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.getElementById('chatgpt').value = <?= $chatgpt ?> ;
</script>
</body>

</html>