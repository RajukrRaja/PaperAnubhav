<?php $__env->startSection('title', $community->name . ' chat — ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<div class="chat-page" style="max-width: 850px; margin: 0 auto; padding: var(--space-8) var(--container-gutter);">
    <header class="chat-heading flex items-center justify-between gap-4 mb-6 flex-wrap">
        <div>
            <a href="<?php echo e(route('community.index')); ?>" class="text-link text-sm mb-2 inline-block">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline mr-1">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                All communities
            </a>
            <h1 style="margin-bottom: var(--space-2);"><?php echo e($community->name); ?></h1>
            <p style="color: var(--color-text-muted);"><?php echo e($community->description); ?></p>
        </div>
        <span class="flex items-center gap-2 text-sm" style="color: var(--color-success); white-space: nowrap;">
            <span class="relative" style="width: 8px; height: 8px;">
                <span class="absolute inset-0 rounded-full" style="background: var(--color-success); animation: pulse 2s infinite;"></span>
            </span>
            Live chat
        </span>
    </header>

    <div id="chat-box" class="card" style="height: min(60vh, 620px); min-height: 320px; overflow-y: auto; padding: var(--space-5); display: flex; flex-direction: column; gap: var(--space-4);" aria-live="polite" aria-label="Community messages">
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="chat-message <?php echo e($message->user_id === auth()->id() ? 'own-message' : ''); ?>" data-message-id="<?php echo e($message->id); ?>" style="max-width: 85%; align-self: <?php echo e($message->user_id === auth()->id() ? 'flex-end' : 'flex-start'); ?>; padding: var(--space-3) var(--space-4); border-radius: var(--radius-lg); <?php echo e($message->user_id === auth()->id() ? 'background: var(--color-primary-light); border: 1px solid var(--color-primary-light);' : 'background: var(--color-surface); border: 1px solid var(--color-border);'); ?>; overflow-wrap: anywhere;">
                <div class="chat-message-meta flex items-center gap-3 mb-2 flex-wrap" style="font-size: var(--text-xs);">
                    <strong style="color: var(--color-text);"><?php echo e($message->user->name); ?></strong>
                    <span style="color: var(--color-text-muted);"><?php echo e($message->created_at->format('M j, g:i A')); ?></span>
                </div>
                <p style="margin: 0; white-space: pre-wrap; line-height: 1.5; color: var(--color-text);"><?php echo e($message->body); ?></p>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <form id="chat-form" class="flex gap-3 mt-4" style="display: flex; gap: var(--space-3);">
        <?php echo csrf_field(); ?>
        <label for="chat-body" class="sr-only">Your message</label>
        <input
            type="text"
            id="chat-body"
            name="body"
            maxlength="2000"
            autocomplete="off"
            placeholder="Write a message..."
            required
            class="form-input"
            style="flex: 1; min-width: 0;"
        >
        <button
            id="chat-send"
            type="submit"
            class="button button-primary"
            style="white-space: nowrap;"
        >
            Send
        </button>
    </form>

    <p id="chat-status" class="text-sm mt-3" style="color: var(--color-text-muted); text-align: center;">Messages refresh automatically.</p>
</div>

<style>
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }

    @media (max-width: 640px) {
        .chat-heading {
            flex-direction: column;
            align-items: flex-start;
        }

        #chat-box {
            height: 60vh;
            min-height: 280px;
            padding: var(--space-4);
        }

        .chat-message {
            max-width: 95%;
        }

        #chat-form {
            flex-direction: column;
        }

        #chat-form .button {
            width: 100%;
        }
    }
</style>

<script>
    (() => {
        const box = document.getElementById('chat-box');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('chat-body');
        const send = document.getElementById('chat-send');
        const status = document.getElementById('chat-status');
        const listUrl = <?php echo json_encode(route('community.messages', $community), 512) ?>;
        const sendUrl = <?php echo json_encode(route('community.messages.send', $community), 512) ?>;
        const csrf = <?php echo json_encode(csrf_token(), 15, 512) ?>;
        let lastId = Math.max(0, ...Array.from(box.querySelectorAll('[data-message-id]')).map(el => Number(el.dataset.messageId)));
        let sending = false;

        function appendMessage(message) {
            if (box.querySelector('[data-message-id="' + message.id + '"]')) return;
            const article = document.createElement('article');
            const isOwn = Number(message.user.id) === <?php echo e(auth()->id()); ?>;
            article.className = 'chat-message' + (isOwn ? ' own-message' : '');
            article.dataset.messageId = message.id;
            article.style.cssText = 'max-width: 85%; align-self: ' + (isOwn ? 'flex-end' : 'flex-start') + '; padding: var(--space-3) var(--space-4); border-radius: var(--radius-lg); ' + (isOwn ? 'background: var(--color-primary-light); border: 1px solid var(--color-primary-light);' : 'background: var(--color-surface); border: 1px solid var(--color-border);') + ' overflow-wrap: anywhere;';

            const meta = document.createElement('div');
            meta.className = 'chat-message-meta';
            meta.style.cssText = 'display: flex; gap: var(--space-3); align-items: center; flex-wrap: wrap; font-size: var(--text-xs); margin-bottom: var(--space-2);';

            const name = document.createElement('strong');
            name.textContent = message.user.name;
            name.style.color = 'var(--color-text)';

            const time = document.createElement('span');
            time.textContent = new Date(message.created_at).toLocaleString([], {month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit'});
            time.style.color = 'var(--color-text-muted)';

            const body = document.createElement('p');
            body.textContent = message.body;
            body.style.cssText = 'margin: 0; white-space: pre-wrap; line-height: 1.5; color: var(--color-text);';

            meta.append(name, time);
            article.append(meta, body);
            box.appendChild(article);
            lastId = Math.max(lastId, Number(message.id));
        }

        async function refreshMessages() {
            try {
                const response = await fetch(listUrl + '?after=' + lastId, {headers: {'Accept': 'application/json'}, credentials: 'same-origin'});
                if (response.status === 403) {
                    status.textContent = 'You no longer have access to this community chat.';
                    return;
                }
                if (!response.ok) throw new Error('Unable to refresh messages.');
                const data = await response.json();
                data.messages.forEach(appendMessage);
                if (data.messages.length) box.scrollTop = box.scrollHeight;
                status.textContent = 'Messages refresh automatically.';
            } catch (error) {
                status.textContent = 'Connection issue. Retrying automatically...';
            }
        }

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const body = input.value.trim();
            if (!body || sending) return;
            sending = true;
            send.disabled = true;
            try {
                const response = await fetch(sendUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify({body})
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Message could not be sent.');
                appendMessage(data.message);
                input.value = '';
                box.scrollTop = box.scrollHeight;
                status.textContent = 'Message sent.';
            } catch (error) {
                status.textContent = error.message || 'Message could not be sent. Please retry.';
            } finally {
                sending = false;
                send.disabled = false;
                input.focus();
            }
        });

        box.scrollTop = box.scrollHeight;
        window.setInterval(refreshMessages, 2500);
    })();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/community/chat.blade.php ENDPATH**/ ?>