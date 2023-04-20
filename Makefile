
.PHONY: help
help: ## Show this help.
	@printf "\033[33mUsage:\033[0m\n  make [target] [arg=\"val\"...]\n\n\033[33mTargets:\033[0m\n"
	@grep -E '^[-a-zA-Z0-9_\.\/]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: test
test:
	vendor/bin/phpunit

.PHONY: phpstan
phpstan:
	vendor/bin/phpstan

.PHONY: psalm
psalm:
	vendor/bin/psalm

.PHONY: fix
fix:
	vendor/bin/php-cs-fixer fix

.PHONY: fix-dry
fix-dry:
	vendor/bin/php-cs-fixer fix --diff --dry-run

.PHONY: rector
rector:
	vendor/bin/rector process

.PHONY: rector-dry
rector-dry:
	vendor/bin/rector process --dry-run

.PHONY: ci
ci: phpstan psalm test rector-dry fix-dry
