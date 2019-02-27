FROM bjddd192/redash:5.0.0.b4754

USER root

RUN useradd --create-home --no-log-init --shell /bin/bash gtp_select

RUN chown -R gtp_select /app

USER gtp_select
