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
                    <a class="mx-auto block w-2/5 px-12 py-3 text-sm font-medium text-white bg-slate-600 border border-slate-600 rounded-full active:text-slate-500 hover:bg-transparent hover:text-slate-600 focus:outline-none focus:ring" href="/new">New Chat</a>
                </div>
                <div class="inline-block flex justify-center">
                    <button class="w-3/5 border-2 border-slate-400 rounded my-2 py-4">22/1/2024</button>
                </div>
            </div>
        </div>
        <div class="flex-auto w-3/5 bg-slate-50 py-5 px-5 lg:px-12 flex justify-center">
            <div class="lg:w-3/5 flex flex-wrap">
                <!-- <p>ChatGPT 4</p> -->

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
                        <input type="text" class="border-2 border-slate-400 rounded-full h-16 w-full px-8" name="prompt" id="" placeholder="prompt">
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