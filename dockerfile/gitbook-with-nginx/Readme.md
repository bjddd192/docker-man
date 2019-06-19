# gitbook-with-nginx

GitBook 是一个基于 Node.js 的命令行工具，可使用 Github/Git 和 Markdown 来制作精美的电子书。

因 `gitbook serve` 只能生成在根目录启动，使用 nginx 反向代理存在缺陷，故制作本镜像，在 nginx 1.17.0-alpine 版本基础上，初始化了 gitbook 组件，并采用 nginx 进行灵活的部署。

静态文件挂载目录：`/usr/share/nginx/html`。可以使用编译好的静态文件挂载进去，也可以扩展从 git 仓库拉取进行编译。
