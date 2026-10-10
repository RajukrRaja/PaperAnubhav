<?php $__env->startSection('title', 'Chat with ' . $user->name . ' — ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .ec-chat {
        --chat-primary: #4f46e5;
        --chat-border: #e5e7eb;
        --chat-muted: #6b7280;
        --chat-text: #111827;
        width: 100%;
        max-width: 1050px;
        margin: 0 auto;
        padding: 20px 16px 35px;
        color: var(--chat-text);
    }

    .ec-chat *,
    .ec-chat *::before,
    .ec-chat *::after {
        box-sizing: border-box;
    }

    .ec-chat-shell {
        height: min(760px, calc(100dvh - 150px));
        min-height: 450px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--chat-border);
        border-radius: 18px;
        box-shadow: 0 8px 30px rgb(15 23 42 / 5%);
    }

    /* Header */

    .ec-chat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 16px 20px;
        border-bottom: 1px solid var(--chat-border);
        background: #fff;
    }

    .ec-chat-person {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .ec-chat-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border: 1px solid var(--chat-border);
        border-radius: 10px;
        color: #374151;
        text-decoration: none;
    }

    .ec-chat-back:hover {
        background: #f9fafb;
    }

    .ec-chat-avatar {
        width: 46px;
        height: 46px;
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 50%;
        background: #eef2ff;
        color: var(--chat-primary);
        font-size: 17px;
        font-weight: 800;
    }

    .ec-chat-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ec-chat-person-info {
        min-width: 0;
    }

    .ec-chat-person-info h1 {
        margin: 0;
        overflow: hidden;
        color: #111827;
        font-size: 16px;
        font-weight: 750;
        line-height: 1.4;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ec-chat-username {
        margin-top: 3px;
        overflow: hidden;
        color: var(--chat-muted);
        font-size: 12px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ec-chat-header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ec-chat-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border: 1px solid var(--chat-border);
        border-radius: 10px;
        background: #fff;
        color: #4b5563;
        cursor: pointer;
        text-decoration: none;
    }

    .ec-chat-action:hover {
        background: #f9fafb;
    }

    /* Conversation */

    .ec-chat-messages {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 7px;
        min-height: 0;
        overflow-y: auto;
        padding: 24px clamp(12px, 4vw, 42px);
        background-color: #fafbff;
        background-image: radial-gradient(#e5e7eb 0.65px, transparent 0.65px);
        background-size: 18px 18px;
        scroll-behavior: smooth;
        overscroll-behavior: contain;
    }

    .ec-chat-date {
        display: flex;
        justify-content: center;
        margin: 12px 0;
    }

    .ec-chat-date span {
        padding: 6px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        background: #fff;
        color: #6b7280;
        font-size: 11px;
        font-weight: 650;
        box-shadow: 0 1px 3px rgb(15 23 42 / 3%);
    }

    .ec-message-row {
        display: flex;
        width: 100%;
        align-items: flex-end;
        gap: 8px;
        animation: ecMessageIn .18s ease-out;
    }

    .ec-message-row.mine {
        justify-content: flex-end;
    }

    .ec-message-row.theirs {
        justify-content: flex-start;
    }

    .ec-message-mini-avatar {
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 50%;
        background: #e0e7ff;
        color: #4338ca;
        font-size: 10px;
        font-weight: 800;
    }

    .ec-message-mini-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ec-message-content {
        max-width: min(76%, 520px);
        min-width: 0;
    }

    .ec-message-sender {
        margin: 0 0 5px 4px;
        color: #6b7280;
        font-size: 11px;
        font-weight: 650;
    }

    .ec-message-bubble {
        position: relative;
        padding: 11px 14px 8px;
        border: 1px solid #e5e7eb;
        border-radius: 15px 15px 15px 4px;
        background: #fff;
        box-shadow: 0 2px 5px rgb(15 23 42 / 3%);
    }

    .ec-message-row.mine .ec-message-bubble {
        border-color: #4f46e5;
        border-radius: 15px 15px 4px 15px;
        background: #4f46e5;
        color: #fff;
        box-shadow: 0 3px 8px rgb(79 70 229 / 12%);
    }

    .ec-message-text {
        margin: 0;
        overflow-wrap: anywhere;
        white-space: pre-wrap;
        font-size: 14px;
        line-height: 1.65;
    }

    .ec-message-meta {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 5px;
        margin-top: 6px;
        color: #9ca3af;
        font-size: 10px;
        white-space: nowrap;
    }

    .ec-message-row.mine .ec-message-meta {
        color: rgb(255 255 255 / 78%);
    }

    .ec-message-ticks {
        display: inline-flex;
        align-items: center;
        font-size: 12px;
        font-weight: 800;
    }

    .ec-message-ticks.read {
        color: #bfdbfe;
    }

    @keyframes ecMessageIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Empty conversation */

    .ec-chat-empty {
        display: flex;
        flex: 1;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px 15px;
        text-align: center;
    }

    .ec-chat-empty-avatar {
        display: flex;
        width: 76px;
        height: 76px;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        border-radius: 50%;
        background: #eef2ff;
        color: var(--chat-primary);
        font-size: 27px;
        font-weight: 800;
    }

    .ec-chat-empty h2 {
        margin: 0 0 8px;
        font-size: 19px;
        font-weight: 800;
    }

    .ec-chat-empty p {
        max-width: 310px;
        margin: 0;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.7;
    }

    /* Typing indicator - visual demo only */

    .ec-chat-typing {
        display: none;
        align-items: center;
        gap: 9px;
        padding: 0 25px 12px;
        background: #fafbff;
        color: #6b7280;
        font-size: 11px;
    }

    .ec-chat-typing.visible {
        display: flex;
    }

    .ec-typing-dots {
        display: flex;
        align-items: center;
        gap: 3px;
        padding: 8px 10px;
        border: 1px solid var(--chat-border);
        border-radius: 12px;
        background: #fff;
    }

    .ec-typing-dots span {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #9ca3af;
        animation: ecTyping 1s infinite ease-in-out;
    }

    .ec-typing-dots span:nth-child(2) {
        animation-delay: .15s;
    }

    .ec-typing-dots span:nth-child(3) {
        animation-delay: .3s;
    }

    @keyframes ecTyping {
        0%, 60%, 100% {
            opacity: .4;
            transform: translateY(0);
        }
        30% {
            opacity: 1;
            transform: translateY(-3px);
        }
    }

    /* Composer */

    .ec-chat-composer {
        position: relative;
        flex-shrink: 0;
        padding: 14px 18px 12px;
        border-top: 1px solid var(--chat-border);
        background: #fff;
    }

    .ec-chat-form {
        display: flex;
        align-items: flex-end;
        gap: 10px;
    }

    .ec-chat-tools {
        display: flex;
        align-items: center;
        gap: 5px;
        padding-bottom: 5px;
    }

    .ec-chat-tool {
        display: flex;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: #6b7280;
        cursor: pointer;
    }

    .ec-chat-tool:hover {
        background: #f3f4f6;
        color: var(--chat-primary);
    }

    .ec-chat-input-wrap {
        display: flex;
        flex: 1;
        min-width: 0;
        align-items: flex-end;
        padding: 4px 5px 4px 14px;
        border: 1px solid #d1d5db;
        border-radius: 14px;
        background: #fff;
        transition: border-color .2s, box-shadow .2s;
    }

    .ec-chat-input-wrap:focus-within {
        border-color: var(--chat-primary);
        box-shadow: 0 0 0 3px rgb(79 70 229 / 9%);
    }

    .ec-chat-textarea {
        display: block;
        flex: 1;
        min-width: 0;
        min-height: 38px;
        max-height: 140px;
        resize: none;
        padding: 9px 0;
        border: 0;
        outline: none;
        background: transparent;
        color: #111827;
        font: inherit;
        font-size: 14px;
        line-height: 1.5;
    }

    .ec-chat-textarea::placeholder {
        color: #9ca3af;
    }

    .ec-chat-counter {
        align-self: flex-end;
        padding: 0 5px 9px;
        color: #9ca3af;
        font-size: 10px;
        white-space: nowrap;
    }

    .ec-chat-send {
        display: flex;
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 13px;
        background: var(--chat-primary);
        color: #fff;
        cursor: pointer;
        transition: background .2s, transform .15s;
    }

    .ec-chat-send:hover {
        background: #4338ca;
    }

    .ec-chat-send:active {
        transform: scale(.96);
    }

    .ec-chat-send:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .ec-chat-hint {
        margin: 8px 0 0;
        color: #9ca3af;
        font-size: 10px;
        text-align: center;
    }

    /* Emoji picker */

    .ec-emoji-picker {
        position: absolute;
        z-index: 20;
        bottom: calc(100% - 5px);
        left: 20px;
        display: none;
        width: min(290px, calc(100vw - 40px));
        padding: 12px;
        border: 1px solid var(--chat-border);
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 12px 40px rgb(15 23 42 / 12%);
    }

    .ec-emoji-picker.visible {
        display: block;
    }

    .ec-emoji-picker h3 {
        margin: 0 0 10px;
        color: #374151;
        font-size: 12px;
    }

    .ec-emoji-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
    }

    .ec-emoji {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 0;
        padding: 7px 0;
        border: 0;
        border-radius: 7px;
        background: transparent;
        font-size: 20px;
        cursor: pointer;
    }

    .ec-emoji:hover {
        background: #f3f4f6;
    }

    .ec-chat-flash {
        margin-bottom: 15px;
    }

    .ec-chat-pagination {
        padding-top: 15px;
    }

    @media (max-width: 600px) {
        .ec-chat {
            padding: 8px 0 20px;
        }

        .ec-chat-shell {
            height: calc(100dvh - 100px);
            min-height: 400px;
            border-right: 0;
            border-left: 0;
            border-radius: 0;
        }

        .ec-chat-header {
            gap: 9px;
            padding: 12px;
        }

        .ec-chat-avatar {
            width: 40px;
            height: 40px;
        }

        .ec-chat-person-info h1 {
            max-width: 170px;
            font-size: 14px;
        }

        .ec-chat-back,
        .ec-chat-action {
            width: 34px;
            height: 34px;
        }

        .ec-chat-messages {
            padding: 16px 10px;
        }

        .ec-message-content {
            max-width: 85%;
        }

        .ec-message-bubble {
            padding: 10px 11px 7px;
        }

        .ec-message-text {
            font-size: 13px;
        }

        .ec-chat-composer {
            padding: 10px;
        }

        .ec-chat-tools {
            gap: 0;
        }

        .ec-chat-tool {
            width: 32px;
            height: 36px;
        }

        .ec-chat-form {
            gap: 5px;
        }

        .ec-chat-input-wrap {
            padding-left: 10px;
        }

        .ec-chat-counter {
            display: none;
        }

        .ec-chat-send {
            width: 42px;
            height: 42px;
        }

        .ec-chat-hint {
            display: none;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .ec-chat *,
        .ec-chat *::before,
        .ec-chat *::after {
            animation-duration: .01ms !important;
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="ec-chat">

    <?php if(session('success')): ?>
        <div class="alert alert-success ec-chat-flash" role="status">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-error ec-chat-flash" role="alert">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <div class="ec-chat-shell">

        
        <header class="ec-chat-header">
            <div class="ec-chat-person">
                <a class="ec-chat-back"
                   href="<?php echo e(route('messages.index')); ?>"
                   aria-label="Back to all messages"
                   title="All messages">
                    <svg width="19" height="19" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"></path>
                        <path d="m12 19-7-7 7-7"></path>
                    </svg>
                </a>

                <div class="ec-chat-avatar">
                    <?php if($user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>"
                             alt="<?php echo e($user->name); ?>"
                             onerror="this.style.display='none'">
                    <?php endif; ?>
                    <span><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></span>
                </div>

                <div class="ec-chat-person-info">
                    <h1><?php echo e($user->name); ?></h1>
                    <div class="ec-chat-username">
                        <?php echo e('@' . $user->username); ?> · ExamConnect
                    </div>
                </div>
            </div>

            <div class="ec-chat-header-actions">
                <a href="<?php echo e(route('messages.index')); ?>"
                   class="ec-chat-action"
                   title="All conversations"
                   aria-label="All conversations">
                    <svg width="19" height="19" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
                    </svg>
                </a>
            </div>
        </header>

        
        <div id="ecChatMessages" class="ec-chat-messages"
             aria-label="Conversation messages"
             aria-live="polite">

            <?php
                $lastDate = null;
                $hasMessages = $messages->count() > 0;
            ?>

            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $isMine = (int) $message->sender_id === (int) auth()->id();
                    $messageDate = $message->created_at->format('Y-m-d');

                    if ($messageDate === now()->format('Y-m-d')) {
                        $dateLabel = 'Today';
                    } elseif ($messageDate === now()->subDay()->format('Y-m-d')) {
                        $dateLabel = 'Yesterday';
                    } else {
                        $dateLabel = $message->created_at->format('F j, Y');
                    }
                ?>

                <?php if($lastDate !== $messageDate): ?>
                    <div class="ec-chat-date">
                        <span><?php echo e($dateLabel); ?></span>
                    </div>
                    <?php $lastDate = $messageDate; ?>
                <?php endif; ?>

                <div class="ec-message-row <?php echo e($isMine ? 'mine' : 'theirs'); ?>"
                     data-message-id="<?php echo e($message->id ?? ''); ?>">

                    <?php if(!$isMine): ?>
                        <div class="ec-message-mini-avatar">
                            <?php if($user->avatar): ?>
                                <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>"
                                     alt=""
                                     onerror="this.style.display='none'">
                            <?php endif; ?>
                            <span><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="ec-message-content">
                        <?php if(!$isMine): ?>
                            <div class="ec-message-sender"><?php echo e($user->name); ?></div>
                        <?php endif; ?>

                        <div class="ec-message-bubble">
                            <p class="ec-message-text"><?php echo e($message->body); ?></p>

                            <div class="ec-message-meta">
                                <time datetime="<?php echo e($message->created_at->toIso8601String()); ?>">
                                    <?php echo e($message->created_at->format('g:i A')); ?>

                                </time>

                                <?php if($isMine): ?>
                                    <span class="ec-message-ticks <?php echo e($message->read_at ? 'read' : ''); ?>"
                                          title="<?php echo e($message->read_at ? 'Read' : 'Sent'); ?>">
                                        <?php echo e($message->read_at ? '✓✓' : '✓'); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="ec-chat-empty" id="ecChatEmpty">
                    <div class="ec-chat-empty-avatar">
                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                    </div>
                    <h2>Say hello to <?php echo e($user->name); ?></h2>
                    <p>
                        You are now connected here. Start a conversation about
                        exams, preparation, experiences or anything helpful.
                    </p>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="ec-chat-typing" id="ecChatTyping" aria-hidden="true">
            <div class="ec-typing-dots">
                <span></span><span></span><span></span>
            </div>
            <span><?php echo e($user->name); ?> is typing...</span>
        </div>

        
        <div class="ec-chat-composer">
            <div class="ec-emoji-picker" id="ecEmojiPicker">
                <h3>Choose an emoji</h3>
                <div class="ec-emoji-grid">
                    <?php $__currentLoopData = ['😀','😂','😊','😍','🥳','🤔','😎','😭','🙏','👍','👎','👏','❤️','🔥','🎉','💯','✨','💪','🙌','🤝','😅','🙂','😉','🤗','💙','⭐','📚','✍️','🎯','🚀','☕','💡','🫡','😄','🥹','❤️‍🔥','✅','❓','🎓','📖','🏆','💬','🤞','💐']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emoji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="ec-emoji"
                                data-emoji="<?php echo e($emoji); ?>"
                                aria-label="Insert <?php echo e($emoji); ?>"><?php echo e($emoji); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <form id="ecChatForm"
                  class="ec-chat-form"
                  method="POST"
                  action="<?php echo e(route('messages.send', $user->username)); ?>">
                <?php echo csrf_field(); ?>

                <div class="ec-chat-tools">
                    <button type="button" class="ec-chat-tool"
                            id="ecEmojiToggle"
                            title="Emoji"
                            aria-label="Open emoji picker"
                            aria-expanded="false">
                        <svg width="22" height="22" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="1.7"
                             stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <path d="M9 9h.01M15 9h.01"></path>
                        </svg>
                    </button>
                </div>

                <div class="ec-chat-input-wrap">
                    <textarea
                        id="ecChatInput"
                        name="body"
                        rows="1"
                        maxlength="3000"
                        required
                        placeholder="Write a message..."
                        aria-label="Write a message"
                        class="ec-chat-textarea"
                    ><?php echo e(old('body')); ?></textarea>

                    <span class="ec-chat-counter" id="ecChatCounter">0/3000</span>
                </div>

                <button type="submit" class="ec-chat-send"
                        id="ecChatSend"
                        aria-label="Send message"
                        title="Send message">
                    <svg width="21" height="21" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="m22 2-7 20-4-9-9-4Z"></path>
                        <path d="M22 2 11 13"></path>
                    </svg>
                </button>
            </form>

            <p class="ec-chat-hint">Press Enter to send · Shift + Enter for a new line</p>
        </div>
    </div>

    <div class="ec-chat-pagination">
        <?php echo e($messages->links()); ?>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const messageList = document.getElementById('ecChatMessages');
    const input = document.getElementById('ecChatInput');
    const form = document.getElementById('ecChatForm');
    const sendButton = document.getElementById('ecChatSend');
    const counter = document.getElementById('ecChatCounter');
    const emojiToggle = document.getElementById('ecEmojiToggle');
    const emojiPicker = document.getElementById('ecEmojiPicker');

    if (!messageList || !input || !form) return;

    // Open the conversation at its latest message.
    messageList.scrollTop = messageList.scrollHeight;

    // Keep the textarea compact until multiple lines are needed.
    function resizeInput() {
        input.style.height = 'auto';
        input.style.height = Math.min(input.scrollHeight, 140) + 'px';

        counter.textContent = input.value.length + '/3000';
        sendButton.disabled = input.value.trim().length === 0;
    }

    input.addEventListener('input', resizeInput);
    resizeInput();

    // Enter sends; Shift + Enter inserts a newline.
    input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && !event.shiftKey && !event.isComposing) {
            event.preventDefault();

            if (input.value.trim()) {
                form.requestSubmit();
            }
        }
    });

    // Emoji picker.
    emojiToggle.addEventListener('click', function () {
        const isOpen = emojiPicker.classList.toggle('visible');
        emojiToggle.setAttribute('aria-expanded', String(isOpen));
    });

    emojiPicker.querySelectorAll('[data-emoji]').forEach(function (button) {
        button.addEventListener('click', function () {
            const emoji = this.dataset.emoji;
            const start = input.selectionStart;
            const end = input.selectionEnd;
            const value = input.value;

            input.value = value.slice(0, start) + emoji + value.slice(end);

            const cursor = start + emoji.length;
            input.focus();
            input.setSelectionRange(cursor, cursor);

            resizeInput();
        });
    });

    document.addEventListener('click', function (event) {
        if (!emojiPicker.contains(event.target) &&
            !emojiToggle.contains(event.target)) {
            emojiPicker.classList.remove('visible');
            emojiToggle.setAttribute('aria-expanded', 'false');
        }
    });

    // Avoid accidental double submissions.
    form.addEventListener('submit', function (event) {
        if (!input.value.trim()) {
            event.preventDefault();
            input.focus();
            return;
        }

        if (form.dataset.submitting === '1') {
            event.preventDefault();
            return;
        }

        form.dataset.submitting = '1';
        sendButton.disabled = true;
        sendButton.style.opacity = '.65';
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/messages/show.blade.php ENDPATH**/ ?>