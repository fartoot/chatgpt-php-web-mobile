<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/resources/style/style.css">
</head>

<body>
        <div class="flex h-screen">
                <div id="sidebar" class="flex-auto md:w-3/12 bg-slate-300 absolute md:relative h-screen md:h-full w-full p-4 hidden md:inline">
                        <div class="h-full flex flex-col justify-evenly md:justify-around">
                                <div class="mx-auto">
                                        <a class="inline shadow-md mx-auto  px-6 py-4 text-sm font-medium text-white bg-slate-600 border border-slate-600 rounded-full active:text-slate-500 hover:bg-transparent hover:text-slate-600 focus:outline-none focus:ring" href="/new">
                                                New Chat
                                        </a>
                                </div>
                                <div class="h-4/6 md:h-4/6 flex flex-col justify-between">

                                        <div class="my-5">
                                                <h3 class="flex items-center">
                                                        <span aria-hidden="true" class="flex-grow bg-slate-400 rounded h-0.5"></span>
                                                        <span class="inline-block px-4 py-1 text-sm font-medium text-center text-slate-700 bg-slate-400 rounded-full">
                                                                History
                                                        </span>
                                                        <span aria-hidden="true" class="flex-grow bg-slate-400 rounded h-0.5"></span>
                                                </h3>
                                        </div>

                                        <div class="grid grid-cols-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-2 h-full overflow-y-auto">
                                                <?php for ($i = $chats; $i >= 1; $i--) {
                                                        if ($i == $id) {
                                                ?>
                                                                <a href="/show/<?= $i ?>" class="flex justify-center items-center aspect-square border-2 border-slate-400 bg-white focus:ring-2 hover:ring-slate-400 rounded-lg hover:bg-white focus:bg-white hover:shadow-lg">
                                                                        <span class="text-slate-800"><?= $i ?></span>
                                                                </a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                                <a href="/show/<?= $i ?>" class="flex justify-center items-center aspect-square border-2 border-slate-400 focus:ring-2 hover:ring-slate-400 rounded-lg hover:bg-white focus:bg-white hover:shadow-lg">
                                                                        <span class="text-slate-800"><?= $i ?></span>
                                                                </a>
                                                <?php }
                                                } ?>

                                        </div>
                                </div>

                                <div class="hidden md:inline">
                                        <img class="w-1/2 xl:w-1/3 mx-auto m-3 rounded-lg" src="/imgs/qrcode.svg" alt="">
                                        <p class="text-center -m-2 font-mono text-slate-900">scan me</p>
                                </div>
                        </div>
                </div>
                <div class="bg-slate-50 w-full py-5 px-5 lg:px-12 flex justify-center">
                        <div class="lg:w-4/5 xl:w-3/5 flex flex-wrap">
                                <div class="mb-3 md:mb-0 flex justify-between w-full">
                                        <div class="flex items-center justify-center">
                                                <div>
                                                        <select id="chatgpt" onchange="selectedChagpt()" class="space-x-40 bg-inherit rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-slate-400">
                                                                <option value="0">ChatGPT 4</option>
                                                                <option value="1">ChatGPT 3.5</option>
                                                        </select>
                                                </div>
                                        </div>

                                        <button id="toggle-sidebar-button" class="z-50 md:hidden relative">
                                                <span class="sr-only">Toggle Menu</span>
                                                <div id="open" class="h-7 flex flex-col items-end justify-between">
                                                        <span class="block h-0.5 w-8 bg-slate-400 rounded-full"></span>
                                                        <span class="block h-0.5 w-6 bg-slate-400 rounded-full"></span>
                                                        <span class="block h-0.5 w-8 bg-slate-400 rounded-full"></span>
                                                </div>
                                                <div id="close" class="hidden h-7 flex flex-col items-end justify-between">
                                                        <span class="block h-0.5 w-8 bg-slate-600 rounded-full origin-left transform rotate-45 translate-y-0.5"></span>
                                                        <span class="block h-0.5 w-8 bg-slate-600 rounded-full origin-left transform -rotate-45 -translate-y-0.5"></span>
                                                </div>
                                        </button>

                                </div>

                                <div id="content" class="h-5/6 w-full overflow-y-auto ">
                                        <?php
                                        foreach ($data["answers"] as $answer) {
                                                echo "<div class='bg-white p-3 mb-3 space-y-1.5 border-2 border-slate-300 rounded-md'>";
                                                echo "<p class='mb-2 text-base font-bold'>" . $answer["question"] . "</p>";
                                                echo $Parsedown->text($answer["answer"]);
                                                echo "</div>";
                                        }
                                        ?>

                                        <div id="loading" class='hidden flex m-4 space-x-2 justify-center items-center dark:invert'>
                                                <span class='sr-only'>Loading...</span>
                                                <div class='h-3 w-3 bg-slate-600 rounded-full animate-bounce [animation-delay:-0.3s]'></div>
                                                <div class='h-3 w-3 bg-slate-600 rounded-full animate-bounce [animation-delay:-0.15s]'></div>
                                                <div class='h-3 w-3 bg-slate-600 rounded-full animate-bounce'></div>
                                        </div>
                                </div>

                                <div class="w-full">
                                        <form action="/create/<?= $id ?>" method="post" onSubmit="return loading()" class="flex">
                                                <input type="hidden" name="chagpt" id="selectedChagpt" value="<?= $chatgpt ?>">
                                                <div class="relative w-full">
                                                        <input type="text" class="shadow-lg border-2 pr-16 border-slate-300 hover:border-slate-400 active:border-slate-400 rounded-full h-16 w-full px-8" name="prompt" placeholder="Your prompt ...">
                                                        <button type="submit" class="aspect-square  p-2 text-white absolute inset-y-0 right-0 m-2   font-medium rounded-full text-sm  bg-slate-600 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">
                                                                
                                                                <svg class="w-8  " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                        <path d="M21.707 2.293a1 1 0 0 0-1.069-.225l-18 7a1 1 0 0 0 .145 1.909l8.379 1.861 1.862 8.379a1 1 0 0 0 .9.78L14 22a1 1 0 0 0 .932-.638l7-18a1 1 0 0 0-.225-1.069zm-7.445 15.275L13.1 12.319l2.112-2.112a1 1 0 0 0-1.414-1.414L11.681 10.9 6.432 9.738l12.812-4.982z" style="fill:#fff" data-name="Share" />
                                                                </svg>
                                                        </button>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>

        <script type="text/javascript">
                function selectedChagpt() {
                        type = document.getElementById("chatgpt").value;
                        document.getElementById("selectedChagpt").value = type;
                }

                document.getElementById('chatgpt').value = <?= $chatgpt ?>;
                document.getElementById('content').scrollTop = 9999999;

                function loading() {
                        document.getElementById("loading").style.display = "flex";
                        document.getElementById('content').scrollTop = 9999999;
                }


                var button = document.querySelector('#toggle-sidebar-button');
                var open = document.querySelector('#open');
                var close = document.querySelector('#close');
                var sidebar = document.querySelector("#sidebar")

                button.addEventListener('click', (e) => {
                        open.classList.toggle('hidden');
                        close.classList.toggle('hidden');
                        sidebar.classList.toggle('hidden');
                });
        </script>
</body>

</html>